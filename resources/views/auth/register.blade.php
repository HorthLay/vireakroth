{{-- <!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="form/image/png" href="form/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="form/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="form/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="form/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="form/vendor/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="form/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="form/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="form/vendor/select2/select2.min.css">	
	<link rel="stylesheet" type="text/css" href="form/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="form/css/util.css">
	<link rel="stylesheet" type="text/css" href="form/css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('form/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form method="POST" action="{{ route('register') }}" class="login100-form validate-form flex-sb flex-w">
					@csrf
					<span class="login100-form-title p-b-53">
						Sign Up
					</span>

					<div class="p-t-31 p-b-9">
						<span class="txt1">Name</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Name is required">
						<input class="input100" type="text" name="name" required>
						<span class="focus-input100"></span>
					</div>
					@error('name')
						<p style="color: red;">{{ $message }}</p>
					@enderror

					<div class="p-t-31 p-b-9">
						<span class="txt1">Email</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Email is required">
						<input class="input100" type="email" name="email" required>
						<span class="focus-input100"></span>
					</div>
					@error('email')
						<p style="color: red;">{{ $message }}</p>
					@enderror

					<div class="p-t-31 p-b-9">
						<span class="txt1">Phone Number</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Phone number is required">
						<input class="input100" type="text" name="phone" required>
						<span class="focus-input100"></span>
					</div>
					@error('phone')
						<p style="color: red;">{{ $message }}</p>
					@enderror

					<div class="p-t-13 p-b-9">
						<span class="txt1">Password</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" required>
						<span class="focus-input100"></span>
					</div>
					@error('password')
						<p style="color: red;">{{ $message }}</p>
					@enderror

					<div class="p-t-13 p-b-9">
						<span class="txt1">Confirm Password</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password confirmation is required">
						<input class="input100" type="password" name="password_confirmation" required>
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							Sign Up
						</button>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">Already have an account?</span>

						<a href="{{ route('login') }}" class="txt2 bo1">
							Sign in now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>

	<script src="form/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="form/vendor/animsition/js/animsition.min.js"></script>
	<script src="form/vendor/bootstrap/js/popper.js"></script>
	<script src="form/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="form/vendor/select2/select2.min.js"></script>
	<script src="form/vendor/daterangepicker/moment.min.js"></script>
	<script src="form/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="form/vendor/countdowntime/countdowntime.js"></script>
	<script src="form/js/main.js"></script>

</body>
</html> --}}




<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="logins/images/icons/favicon.ico"/>
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

				<form method="POST" action="{{ route('register') }}" class="login100-form validate-form">
					@csrf
					<span class="login100-form-title">
						Rigister
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="name" placeholder="Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					@error('name')
					<p class="text-danger" style="margin-top: 5px;">{{ $message }}</p>
				@enderror

				

					<div class="wrap-input100 validate-input" data-validate = "Phone is required">
						<input class="input100" type="text" name="phone" placeholder="Phone">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>
					
					

					@error('phone')
						<p class="text-danger" style="margin-top: 5px;">{{ $message }}</p>
					@enderror
				
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					@error('email')
						<p class="text-danger" style="margin-top: 5px;">{{ $message }}</p>
					@enderror

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
				

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					@error('password_confirmation')
					<p class="text-danger" style="margin-top: 5px;">{{ $message }}</p>
				@enderror
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign Up
						</button>
					</div>

					
					

					

					<div class="text-center p-t-136">
						<a class="txt2" href="{{url('/login')}}">
							Already have an account
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