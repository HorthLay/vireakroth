<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
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
        <form method="POST" action="{{ route('reset.password.post') }}">
            @csrf
            <input type="text" name="token" value="{{ $token }}" hidden>
            <div class="input-field">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                <label for="email">Email Address</label>
            </div>
            <div class="input-field">
                <input id="password" type="password" name="password" required>
                <label for="password">Enter New Password</label>
            </div>
            <div class="input-field">
                <input id="password-confirm" type="password" name="password_confirmation" required>
                <label for="password-confirm">Confirm Password</label>
            </div>
            <div>
                <button type="submit">
                    Submit
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
</html>
