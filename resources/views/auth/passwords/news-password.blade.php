<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles and Scripts -->
    <link rel="stylesheet" type="text/css" href="{{asset('logins/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset ('logins/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset ('logins/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset ('logins/css/main.css')}}">
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{asset('logins/images/img-01.png')}}" alt="IMG">
                </div>

                <form method="POST" action="{{ route('reset.password.post') }}" class="login100-form validate-form">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <span class="login100-form-title">New Password</span>

                    <!-- Password Field -->
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="New Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Password Confirmation Field -->
                    <div class="wrap-input100 validate-input" data-validate="Password confirmation is required">
                        <input class="input100" type="password" name="password_confirmation" placeholder="Confirm New Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <!-- Error Message Display -->
                    @if($errors->has('password'))
                        <p class="text-danger" style="margin-top: 5px;">{{ $errors->first('password') }}</p>
                    @endif

                    <!-- Submit Button -->
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">Reset Password</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{asset ('logins/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset ('logins/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('logins/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset ('logins/js/main.js')}}"></script>
</body>
</html>
