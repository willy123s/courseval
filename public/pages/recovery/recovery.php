<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery</title>
    <link rel="stylesheet" href="/css/output.css">
</head>

<body class="relative flex flex-col items-center justify-center h-screen">

    <div class="p-6 w-full max-w-[370px] ">
        <h2 class="text-center font-black text-2xl mb-6 text-slate-500">Account Recovery</h2>
        <form action="/recover/verify" method="post">
            <input type="hidden" name="csrf_token" id="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <div class="relative mb-6">
                <input type="username" name="username" id="username" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="username" />
                <label for="username" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Student No / Employee No <span class="text-danger">*</span></label>
            </div>
            <button class="w-full bg-brand hover:bg-brand-dark  rounded-md px-4 py-3 text-stone-50 transition-all">Recover</button>
            <div class="py-4 text-center">
                <a href="/login" class="text-slate-500 text-sm">Back to Log In</a>
            </div>
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