<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('pic/vireakroth.png') }}">
    <title>Success Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #e0f7fa;
            font-family: Arial, sans-serif;
        }

        .success-container {
            text-align: center;
        }

        .checkmark {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            margin-bottom: 20px;
            background-color: #0288d1;
            animation: scale-up 0.5s ease-in-out, fade-in-background 1s ease-in-out;
        }

        .check-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 60px;
            color: white;
            animation: draw-check 1s ease-in-out;
        }

        h1 {
            color: #0288d1;
            animation: fade-in 1s ease-in-out;
        }

        p {
            color: #547290;
            animation: fade-in 1.5s ease-in-out;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            background-color: #0288d1;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            animation: fade-in 2s ease-in-out;
        }

        button:hover {
            background-color: #0277bd;
        }

        @keyframes scale-up {
            0% { transform: scale(0); }
            100% { transform: scale(1); }
        }

        @keyframes fade-in {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes fade-in-background {
            0% { background-color: transparent; }
            100% { background-color: #0288d1; }
        }

        @keyframes draw-check {
            0% { stroke-dashoffset: 100; }
            100% { stroke-dashoffset: 0; }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="checkmark">
            <div class="check-icon">&#10003;</div>
        </div>
        <h1>Success!</h1>
        <p>Please check your Gmail account for the verification email.</p>
    </div>
</body>
</html>
