



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="{{ asset('pic/vireakroth.png') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="logins/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="logins/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="logins/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="logins/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="logins/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="logins/css/util.css">
	<link rel="stylesheet" type="text/css" href="logins/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="logins/images/img-01.png" alt="IMG">
				</div>

				<form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
					@csrf
					<span class="login100-form-title">
						Login
					</span>
				
					<!-- Email Field -->
					<div class="wrap-input100 validate-input" data-validate="Valid email is required: 0XqyN@example.com">
						<input 
							class="input100" 
							type="text" 
							name="email" 
							placeholder="Email" 
							value="{{ old('email') }}"
						>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						
					</div>
				
					<!-- Password Field -->
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input 
							class="input100" 
							type="password" 
							name="password" 
							placeholder="Password"
						>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					@error('password')
						<p class="text-danger" style="margin-top: 5px;">{{ $message }}</p>
					@enderror
					
					<!-- Submit Button -->
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				
					<!-- Google Login Button -->
					<div class="container-login100-form-btn">
						<a href="{{ route('google-auth') }}" class="login100-form-btn" style="display: flex; align-items: center; justify-content: center; gap: 10px; text-decoration: none; color: white;">
							<img src="logins/images/google.png" alt="Google Logo" style="width: 20px; height: 20px;">
							Login with Google
						</a>
					</div>
				
					<!-- Forgot Password Link -->
					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="{{ route('forget.password') }}">
							Username / Password?
						</a>
					</div>
				
					<!-- Create Account Link -->
					<div class="text-center p-t-136">
						<a class="txt2" href="{{ route('register') }}">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
				
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="logins/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="logins/vendor/bootstrap/js/popper.js"></script>
	<script src="logins/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="logins/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="logins/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="logins/js/main.js"></script>

</body>
</html>