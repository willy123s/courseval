<?php
session_start();

require_once("./Helpers/BreadCrumbsHelper.php");

use Makkari\Helpers\Breadcrumb;
// Path to the .env file
$envFilePath = __DIR__ . '/.env';


if (file_exists($envFilePath)) {
    $envContent = file_get_contents($envFilePath);

    // Split the content into lines
    $envLines = explode("\n", $envContent);

    // Process each line
    foreach ($envLines as $line) {
        $line = trim($line);
        if (!empty($line) && strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

spl_autoload_register(function ($className) {

    $c = explode("\\", $className);
    if (file_exists("./Config/" . ucfirst(end($c)) . ".php")) {
        require_once("./Config/" . ucfirst(end($c)) . ".php");
    }
    if (file_exists("./Controllers/" . ucfirst(end($c)) . ".php")) {
        require_once("./Controllers/" . ucfirst(end($c)) . ".php");
    } else {
        if (file_exists("./Models/" . ucfirst(end($c)) . ".php")) {
            require_once("./Models/" . ucfirst(end($c)) . ".php");
        }
    }
});

require_once "./Controllers/Route.php";



use Makkari\Controllers\Route; // Adjust the namespace accordingly if needed
$page = Route::getURI();

$page = Route::getURI();

$pageName = ucfirst($page[1] == "" ? "Dashboard" : $page[1]);
$m = ucfirst($page[2] ?? "");
$currentpage = $page[1];

Route::contentToRender();
