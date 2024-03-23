<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Recovery;
use Makkari\Models\Student;
use Makkari\Models\User;

class Recover extends Controller
{
    public static function index()
    {
        if (self::get()) {
            self::csrfToken();
            $view = new View(PAGES_PATH . "/recovery");
            $view->render("recovery");
        }
    }
    public static function r()
    {
        if (self::get()) {
            self::csrfToken();
            $recover = Recovery::getByToken($_GET['t']);
            if ($recover->getIsActive() == "true") {
                $view = new View(PAGES_PATH . "/recovery");
                $view->render("/update");
            } else {
                echo "<a href='/login'>Back to login</a>";
            }
        }
    }

    public static function update()
    {

        if (self::post() and self::verifyRequest()) {
            $data = array(
                "newpass" => self::clean($_POST['newpassword']),
                "confirm" => self::clean($_POST['confirmpassword']),
            );
            $ruleset = array(
                "newpass" => ['required', 'min_length=6'],
                "confirm" => ['required', 'min_length=6'],
            );

            $validate = Validations::validateData($data, $ruleset);
            if (empty($validate->errors)) {
                $recover = Recovery::getByToken($_GET['t']);
                $match = preg_match("/-SC-/i", $recover->getUsername());
                if ($match) {
                    $user = Student::getByStudNo(self::clean($recover->getUsername()));
                } else {
                    $user = User::getByEmpNo(self::clean($recover->getUsername()));
                }

                if ($data['newpass'] == $data['confirm']) {
                    $user->setPassword(password_hash($data['confirm'], PASSWORD_BCRYPT));

                    if ($user->save()) {
                        self::createNotif("Password was changed.", 1);
                        $recover->setIsActive("false");
                        $recover->save();
                        Redirect::to('/login');
                    } else {
                        self::createNotif("Something went wrong. Please try again.", 0);
                    }
                } else {
                    self::createNotif("New password did not match.", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/recover/r/token?t={$_GET['t']}");
    }
    public static function verify()
    {
        if (self::post() and self::verifyRequest()) {
            $match = preg_match("/-SC-/i", $_POST['username']);
            if ($match) {
                $user = Student::getByStudNo(self::clean($_POST['username']));
            } else {
                $user = User::getByEmpNo(self::clean($_POST['username']));
            }

            if ($user != null) {
                $token = self::generateToken();
                $data = array(
                    "id" => NULL,
                    "username" => $_POST['username'],
                    "token" => $token,
                    "date_created" => date("Y-m-d H:i:s"),
                    "isActive" => 'true'
                );
                $recover = new Recovery(...$data);
                if ($recover->save()) {
                    $lnk = "/recover/r/token?t=" . $token;
                    $msg = "Dear {$user->getFname()},
                        <p>You are receiving this email because a request was made to reset your password for [Your Website/Application Name]. If you did not request this, please ignore this email.</p>
                        
                        <p>To reset your password, please click on the following link:</p>
                        <br>
                        <a href='coursechk.idou-tech.com{$lnk}'>Click Here</a>
                        <br>
                        If the above link does not work, you can copy and paste the following URL into your web browser:
                        <br>
                        coursechk.idou-tech.com{$lnk}
                        <br>
                        Please note that this link will expire in [Time Period, e.g., 24 hours], so make sure to use it promptly.
                        <br>
                        If you have any questions or concerns, please don't hesitate to contact our support team at [Support Email Address].
                        <br><br>
                        Thank you,

                        [PSUSC Course Check Team] Team";

                    // use wordwrap() if lines are longer than 70 characters
                    // $msg = wordwrap($msg, 70);
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    // send email
                    if (mail("{$user->getEmail()}", "Password Recovery", $msg, $headers)) {
                        $message = "<p class='p-2 text-sm border-success bg-success/50 text-success-dark'>Recovery Link has been sent to your email.</p>";
                    }
                }
            } else {
                $message = "<p class='p-2 text-sm border-danger bg-danger/50 text-danger-dark'>Recovery Link has been sent to your email.</p>";
            }

            $view = new View(PAGES_PATH . "/recovery");
            $m = array(
                "message" => $message
            );
            $view->render("/verify", $m);

            // Redirect::to("/recover");
        }
    }
}
