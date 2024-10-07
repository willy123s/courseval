<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('/public/img/PSUSC.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .login-container img {
            width: 100px;
            margin-bottom: 20px;
        }

        .login-container h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .login-container p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #555;
        }

        .login-container form .input-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .login-container form .input-group input {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: transparent;
            font-size: 16px;
            outline: none;
        }

        .login-container form .input-group .fa {
            margin: 0 10px;
            color: #888;
        }

        .login-container form button {
            width: 100%;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container form button:hover {
            background-color: #0056b3;
        }

        .login-container form a {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }

        .login-container form a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="/public/img/psulogo.png" alt="PSU Logo">
        <h2>Course Evaluation System</h2>
        <p><strong>Student's Log in</strong></p>
        <form action="/auth/chk" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <div class="input-group">
                <i class="fa fa-user"></i>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <button type="submit">Log In</button>
            <a href="/recover">Forgot password?</a>
        </form>
    </div>
    <?php
    if (isset($_SESSION['notif'])) {
        echo $_SESSION['notif'];
        unset($_SESSION['notif']);
    }
    ?>
</body>

</html>
