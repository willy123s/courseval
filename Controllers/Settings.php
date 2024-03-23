<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Student;
use Makkari\Models\User;

class Settings extends Controller
{
    public static function index()
    {
        self::checkAuth();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/settings");
            $data = array(
                "pageTitle" => "Account Settings",
                "pageDesc" => "Account Settings",
                "userdata" => self::usersData($_SESSION['user_id'])
            );
            $view->render("/settings", $data);
        }
    }
    public static function changepassword()
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/settings");
            $view->render("changepass");
        }
    }
    public static function updatepass()
    {
        self::checkAuth();
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "oldpass" => self::clean($_POST['oldpassword']),
                "newpass" => self::clean($_POST['newpassword']),
                "confirm" => self::clean($_POST['confirmpassword']),
            );
            $ruleset = array(
                "oldpass" => ['required'],
                "newpass" => ['required', 'min_length=6'],
                "confirm" => ['required', 'min_length=6'],
            );

            $validate = Validations::validateData($data, $ruleset);
            if (empty($validate->errors)) {
                if ($_SESSION['user_type'] != "Student") {
                    $user = User::getById($_SESSION['user_id']);
                } else {
                    $user = Student::getById($_SESSION['user_id']);
                }
                if (password_verify($data['oldpass'], $user->getPassword())) {
                    if ($data['newpass'] == $data['confirm']) {
                        $user->setPassword(password_hash($data['confirm'], PASSWORD_BCRYPT));

                        if ($user->save()) {
                            self::createNotif("Password was changed.", 1);
                        } else {
                            self::createNotif("Something went wrong. Please try again.", 0);
                        }
                    } else {
                        self::createNotif("New password did not match.", 0);
                    }
                } else {
                    self::createNotif("Old password is incorrect", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to('/settings');
    }
}
