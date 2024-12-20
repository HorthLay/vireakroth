{{-- <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funime</title>
    @include('auth.css')
</head>
<body>
    @if (session('status'))
        <div id="status-message" data-message="{{ session('status') }}"></div>
    @endif

    @if (session('error'))
        <div id="error-message" data-message="{{ session('error') }}"></div>
    @endif

    <div class="wrapper">
        <form method="POST" action="{{ route('forget.password.post') }}">
            @csrf
            <div class="input-field">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                <label for="email">Email Address</label>
            </div>

            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <div>
                <button type="submit">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statusMessage = document.getElementById('status-message');
            const errorMessage = document.getElementById('error-message');

            if (statusMessage) {
                alert(statusMessage.getAttribute('data-message'));
            }

            if (errorMessage) {
                alert(errorMessage.getAttribute('data-message'));
            }
        });
    </script>
</body>
</html> --}}



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V5</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="form/image/png" href="form/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="form/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="form/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="form/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="form/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="form/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="form/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="form/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="form/css/util.css">
	<link rel="stylesheet" type="text/css" href="form/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('form/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form method="POST" action="{{ route('forget.password.post') }}" class="login100-form validate-form flex-sb flex-w">
                    @csrf
                    <span class="login100-form-title p-b-53">
						Forgot Password
					</span>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Email
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Email is required">
						<input class="input100" type="email" name="email" required autofocus>
						<span class="focus-input100"></span>
					</div>
                    <div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
						   Send Password Reset Link
						</button>
					</div>
					</div>  
                    @error('email')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statusMessage = document.getElementById('status-message');
            const errorMessage = document.getElementById('error-message');

            if (statusMessage) {
                alert(statusMessage.getAttribute('data-message'));
            }

            if (errorMessage) {
                alert(errorMessage.getAttribute('data-message'));
            }
        });
    </script>
<!--===============================================================================================-->
	<script src="form/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="form/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="form/vendor/bootstrap/js/popper.js"></script>
	<script src="form/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="form/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="form/vendor/daterangepicker/moment.min.js"></script>
	<script src="form/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="form/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="form/js/main.js"></script>

</body>
</html>

