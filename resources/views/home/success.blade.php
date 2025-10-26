<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('pic/vireakroth.png') }}">
    <title>Order Successful ✅</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            overflow-x: hidden;
        }

        /* Animated background particles */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: particles 20s linear infinite;
        }

        @keyframes particles {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-50px);
            }
        }

        .success-container {
            text-align: center;
            max-width: 600px;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        /* Animated checkmark circle */
        .checkmark {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            margin-bottom: 30px;
            background: linear-gradient(135deg, #00d2ff 0%, #3a7bd5 100%);
            animation: scale-up 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55),
                rotate-pulse 2s ease-in-out infinite 1s;
            box-shadow: 0 10px 40px rgba(0, 210, 255, 0.4);
        }

        /* Ripple effect */
        .checkmark::before,
        .checkmark::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid rgba(0, 210, 255, 0.5);
            transform: translate(-50%, -50%);
            animation: ripple 2s ease-out infinite;
        }

        .checkmark::after {
            animation-delay: 1s;
        }

        @keyframes ripple {
            0% {
                width: 100%;
                height: 100%;
                opacity: 1;
            }

            100% {
                width: 200%;
                height: 200%;
                opacity: 0;
            }
        }

        .check-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 70px;
            color: white;
            animation: check-draw 0.8s ease-in-out 0.3s backwards;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        @keyframes check-draw {
            0% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0) rotate(-45deg);
            }

            100% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1) rotate(0deg);
            }
        }

        h1 {
            color: white;
            margin-bottom: 20px;
            font-size: 2.5em;
            font-weight: 700;
            animation: slide-down 0.8s ease-out 0.5s backwards;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        @keyframes slide-down {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .order-info {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            margin: 20px 0;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: fade-slide-up 0.8s ease-out backwards;
            transform-origin: center;
            transition: transform 0.3s ease;
        }

        .order-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.4);
        }

        @keyframes fade-slide-up {
            0% {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Stagger animation for multiple orders */
        .order-info:nth-child(2) {
            animation-delay: 0.8s;
        }

        .order-info:nth-child(3) {
            animation-delay: 1s;
        }

        .order-info:nth-child(4) {
            animation-delay: 1.2s;
        }

        .order-message {
            color: #333;
            font-size: 1.1em;
            margin-bottom: 15px;
            animation: fade-in 1s ease-out 0.8s backwards;
        }

        .order-number {
            color: #667eea;
            font-weight: bold;
            font-size: 1.3em;
            padding: 15px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 10px;
            display: inline-block;
            animation: number-glow 2s ease-in-out infinite 1.5s;
        }

        @keyframes number-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(102, 126, 234, 0.6);
            }
        }

        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 15px 40px;
            border: none;
            background: linear-gradient(135deg, #00d2ff 0%, #3a7bd5 100%);
            color: white;
            font-size: 18px;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            animation: bounce-in 0.8s ease-out 1.2s backwards;
            box-shadow: 0 10px 30px rgba(0, 210, 255, 0.4);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 210, 255, 0.6);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        @keyframes bounce-in {
            0% {
                opacity: 0;
                transform: scale(0.3) translateY(50px);
            }

            50% {
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes scale-up {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes rotate-pulse {

            0%,
            100% {
                transform: rotate(0deg) scale(1);
            }

            50% {
                transform: rotate(5deg) scale(1.02);
            }
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /* Confetti animation */
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #f0f;
            animation: confetti-fall 3s ease-out forwards;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2em;
            }

            .checkmark {
                width: 100px;
                height: 100px;
            }

            .check-icon {
                font-size: 60px;
            }
        }
    </style>
</head>

<body>
    <div class="success-container">
        <div class="checkmark">
            <div class="check-icon">✓</div>
        </div>
        <h1>Order Successful!</h1>

        @php
            $groupedOrders = $orders->groupBy('order_number');
        @endphp

        @foreach ($groupedOrders as $orderNumber => $group)
            <div class="order-info">
                <p class="order-message">Your order has been successfully placed.</p>
                <div class="order-number">Order #{{ $orderNumber }}</div>
            </div>
        @endforeach

        <a class="btn" href="{{ url('/') }}">
            <span style="position: relative; z-index: 1;">Return to Home</span>
        </a>
    </div>

    <script>
        // Create confetti effect
        function createConfetti() {
            const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#f9ca24', '#6c5ce7', '#a29bfe'];
            const confettiCount = 50;

            for (let i = 0; i < confettiCount; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + '%';
                    confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    confetti.style.animationDelay = (Math.random() * 0.5) + 's';
                    document.body.appendChild(confetti);

                    setTimeout(() => confetti.remove(), 5000);
                }, i * 30);
            }
        }

        // Trigger confetti on page load
        window.addEventListener('load', () => {
            setTimeout(createConfetti, 500);
        });
    </script>
</body>

</html>
