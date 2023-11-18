<?php

namespace Makkari\Controllers;

require_once("./Config/DbConfig.php");
class Controller
{
    public static function clean($str)
    {
        $str = trim($str);
        $str = stripslashes($str);
        // $str = htmlspecialchars($str);
        return $str;
    }

    public static function generateDocumentCode($length = 10)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $documentCode = '';

        for ($i = 0; $i < $length; $i++) {
            $documentCode .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $documentCode;
    }
    public static function getDirectDownloadLink($shareLink)
    {
        // Extract the file ID from the share link
        preg_match('/\/file\/d\/(.*?)\//', $shareLink, $matches);

        if (count($matches) >= 2) {
            // Construct the direct download link
            $fileId = $matches[1];
            $directLink = "https://drive.google.com/uc?export=view&id=$fileId";
            return $directLink;
        } else {
            return false; // Invalid share link format
        }
    }
    public static function createVideoLink($link)
    {
        $newlink = str_replace("/view?usp=drive_link", "/preview", $link);
        $newlink = str_replace("watch?v=", "embed/", $newlink);
        return $newlink;
    }


    public static function createNotif($msg, $type)
    {
        $str = "";
        switch ($type) {
            case 1:
                $str = '<div id="notif" class="notif bg-blue-500 text-white px-4 py-2 rounded shadow-md fixed bottom-4 right-4">
                            <div class="flex items-center justify-between">
                                <span>' . $msg . '</span>
                                <button id="dismiss-btn" class="text-white ml-4">
                                    &times;
                                </button>
                            </div>
                        </div>';
                break;
            case 0:
                $str = '<div id="notif" class="notif bg-red-500 text-white px-4 py-2 rounded shadow-md fixed bottom-4 right-4">
                            <div class="flex items-center justify-between">
                                <span>' . $msg . '</span>
                                <button id="dismiss-btn" class="text-white ml-4">
                                    &times;
                                </button>
                            </div>
                        </div>';
                break;
            default:
                # code...
                break;
        }

        $_SESSION['notif'] = $str;
    }
    public static function post()
    {
        return $_SERVER['REQUEST_METHOD'] === "POST";
    }
    public static function get()
    {
        return $_SERVER['REQUEST_METHOD'] === "GET";
    }
    public static function verifyRequest()
    {
        return hash_equals($_POST['csrf_token'], $_SESSION['csrf_token']);
    }
    public static function verifyToken($token)
    {
        return hash_equals($token, $_SESSION['csrf_token']);
    }

    public static function checkAuth($target = NULL)
    {
        if (!isset($_SESSION['usersession'])) {

            if ($target == NULL) {
                header("Location: /");
            } else {
                header("Location: /{$target}");
            }
        }
    }

    // Check if admin or client
    public static function isAuthorized($access)
    {
        if (isset($_SESSION['user_type'])) {
            return ($_SESSION['user_type'] == $access);
        } else {
            return false;
        }
    }

    public static function isLogedIn($target = NULL)
    {
        if (isset($_SESSION['usersession'])) {
            $target = $target == NULL ? "/" : $target;
            header("Location: {$target}");
        }
    }

    public static function csrfToken()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
    }

    public static function generateReference()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $referenceNumber = '';

        for ($i = 0; $i < 8; $i++) {
            $randomIndex = mt_rand(0, strlen($characters) - 1);
            $referenceNumber .= $characters[$randomIndex];
        }

        return $referenceNumber;
    }
}
