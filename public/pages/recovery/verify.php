<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery</title>
    <link rel="stylesheet" href="/css/output.css">
</head>
    
<body class="relative flex flex-col items-center justify-center h-screen bg-cover bg-center" style="background-image: url('\public\img\welcome-slider.webp');">

    <div class="p-6 w-full max-w-[370px] bg-white bg-opacity-80 rounded-md shadow-md">
        <h2 class="text-center font-black text-2xl mb-6 text-slate-500">Recovery Link Sent</h2>
        <p><?= $message ?></p>
    </div>
    <?php
    if (isset($_SESSION['notif'])) {
        echo $_SESSION['notif'];
        unset($_SESSION['notif']);
    }
    ?>
</body>

</html>
