<?php

namespace Makkari\Config;

class Redirect
{
    public static function to($url, $statusCode = 302)
    {
        // Default to a 302 status code if an invalid code is provided
        if (!in_array($statusCode, [301, 302, 303, 307, 308])) {
            $statusCode = 302;
        }

        // Perform the redirect with the specified status code
        header("Location: " . $url, true, $statusCode);
        exit();
    }
}
