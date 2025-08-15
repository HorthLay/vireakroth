#!/bin/bash

# Laravel Docker Deployment Script
echo "🚀 Starting Laravel Docker Deployment..."

# Create necessary directories
echo "📁 Creating Docker configuration directories..."
mkdir -p docker/nginx
mkdir -p docker/php
mkdir -p docker/supervisord

# Copy configuration files
echo "📋 Setting up configuration files..."

# Create nginx config
cat > docker/nginx/nginx.conf << 'EOF'
server {
    listen 80;
    index index.php index.html;
    error_log /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;
    root /var/www/html/public;
    
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
        gzip_static on;
    }
    
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        try_files $uri =404;
    }
}
EOF

# Create PHP config
cat > docker/php/local.ini << 'EOF'
upload_max_filesize=100M
post_max_size=100M
memory_limit=512M
max_execution_time=300
max_input_vars=3000

[Date]
date.timezone=UTC

[opcache]
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0
opcache.save_comments=1
opcache.fast_shutdown=0
EOF

# Create supervisord config
cat > docker/supervisord/supervisord.conf << 'EOF'
[supervisord]
nodaemon=true
user=root
logfile=/var/log/supervisor/supervisord.log
pidfile=/var/run/supervisord.pid

[program:php-fpm]
command=php-fpm -F
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
autorestart=false
startretries=0

[program:nginx]
command=nginx -g 'daemon off;'
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
autorestart=false
startretries=0

[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/html/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/html/storage/logs/worker.log
stopwaitsecs=3600

[program:laravel-scheduler]
command=bash -c "while [ true ]; do (php /var/www/html/artisan schedule:run --verbose --no-interaction &); sleep 60; done"
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/www/html/storage/logs/scheduler.log
EOF

echo "✅ Configuration files created successfully!"

# Build and start containers
echo "🐳 Building and starting Docker containers..."
docker-compose down
docker-compose build --no-cache
docker-compose up -d

# Wait for containers to be ready
echo "⏳ Waiting for containers to start..."
sleep 30

# Run Laravel setup commands
echo "🔧 Running Laravel setup..."
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
docker-compose exec app php artisan migrate --force

# Set proper permissions
echo "🔐 Setting file permissions..."
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chown -R www-data:www-data /var/www/html/bootstrap/cache
docker-compose exec app chmod -R 775 /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/bootstrap/cache

# Clear and optimize
echo "🧹 Clearing and optimizing..."
docker-compose exec app php artisan optimize:clear
docker-compose exec app php artisan optimize

# Show container status
echo "📊 Container Status:"
docker-compose ps

echo "✅ Deployment completed successfully!"
echo ""
echo "🌐 Your Laravel application is now running at:"
echo "   • Application: http://localhost"
echo "   • phpMyAdmin: http://localhost:8080"
echo ""
echo "💾 Database Connection Details:"
echo "   • Host: localhost"
echo "   • Port: 3306"
echo "   • Database: laravel"
echo "   • Username: laravel_user"
echo "   • Password: laravel_password"
echo ""
echo "📝 To view logs: docker-compose logs -f"
echo "🛠️  To access container: docker-compose exec app bash"