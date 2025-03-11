<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="logins/images/icons/favicon.ico"/>

    <!-- Bootstrap & Styles -->
    <link rel="stylesheet" type="text/css" href="logins/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="logins/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="logins/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="logins/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="logins/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="logins/css/util.css">
    <link rel="stylesheet" type="text/css" href="logins/css/main.css">
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="logins/images/img-01.png" alt="IMG">
                </div>

                <form method="POST" action="{{ route('forget.password.post') }}" class="login100-form validate-form">
                    @csrf

                    <!-- Success and Error Messages -->
                   

                    <span class="login100-form-title">
                        Reset Password
                    </span>

                    <!-- Email Field -->
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: example@example.com">
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

                    @if (session('success'))
    <p class="text-success" style="margin-top: 5px;">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p class="text-danger" style="margin-top: 5px;">{{ session('error') }}</p>
@endif

@error('password')
    <p class="text-danger" style="margin-top: 5px;">{{ $message }}</p>
@enderror


                    @error('email')
                        <p class="text-danger" style="margin-top: 5px;">{{ $message }}</p>
                    @enderror

                    <!-- Submit Button -->
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Reset Password
                        </button>
                    </div>

                    <!-- Create Account Link -->
                    <div class="text-center p-t-136">
                        <a class="txt2" href="{{ route('login') }}">
                            Already have an account?
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="logins/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="logins/vendor/bootstrap/js/popper.js"></script>
    <script src="logins/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="logins/vendor/select2/select2.min.js"></script>
    <script src="logins/vendor/tilt/tilt.jquery.min.js"></script>

    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        });

        document.addEventListener("DOMContentLoaded", function() {
        let resetBtn = document.querySelector('.login100-form-btn');
        let errorMsg = document.querySelector('.alert-danger');

        if (errorMsg && errorMsg.innerText.includes("Please wait")) {
            resetBtn.disabled = true;
            setTimeout(() => {
                resetBtn.disabled = false;
            }, 300000); // 5 minutes
        }
    });
    </script>

    <script src="logins/js/main.js"></script>

</body>
</html>
