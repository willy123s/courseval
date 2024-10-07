<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('/public/img/welcome-slider.webp');
            background-size: cover;
        }

        .container {
            max-width: 400px;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 40px;
        }

        .card-title {
            color: #333;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 20px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .btn-primary {
            border-radius: 20px;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .text-secondary {
            font-size: 14px;
        }
    </style>
</head>

<body class="d-flex flex-column justify-content-center align-items-center vh-100">

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center font-weight-bold mb-4">Account Recovery</h2>
                <form action="/recover/verify" method="post">
                    <input type="hidden" name="csrf_token" id="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <div class="form-group">
                        <input type="username" name="username" id="username" class="form-control" placeholder="Student No / Employee No" />
                    </div>
                    <button class="btn btn-primary btn-block">Recover</button>
                    <div class="text-center mt-3">
                        <a href="/login" class="text-secondary">Back to Log In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_SESSION['notif'])) {
        echo $_SESSION['notif'];
        unset($_SESSION['notif']);
    }
    ?>

</body>

</html>
