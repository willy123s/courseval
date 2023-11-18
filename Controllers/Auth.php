<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Student;
use Makkari\Models\User;

class Auth extends Controller
{
    public static function index()
    {
        // Your code here
    }

    public static function chk()
    {
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "username" => $_POST['username'],
                "password" => $_POST['password'],
            );
            $ruleset = array(
                "username" => ['required'],
                "password" => ['required'],
            );
            $validate = Validations::validateData($data, $ruleset);
            if (empty($validate->errors)) {
                $student = Student::getByStudNo($data['username']);
                if ($student) {
                    if (password_verify($data['password'], $student->getPassword())) {
                        $_SESSION['usersession'] = "coursechk" . $student->getId();
                        $_SESSION['user_id'] = $student->getId();
                        $_SESSION['user_type'] = "Student";
                    } else {
                        self::createNotif("Incorrect username and password", 0);
                    }
                } else {
                    self::createNotif("Incorrect username and password", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/login");
    }
    public static function a()
    {
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "username" => $_POST['username'],
                "password" => $_POST['password'],
            );
            $ruleset = array(
                "username" => ['required'],
                "password" => ['required'],
            );
            $validate = Validations::validateData($data, $ruleset);
            if (empty($validate->errors)) {
                $users = User::getByEmpNo($data['username']);
                if ($users) {
                    if (password_verify($data['password'], $users->getPassword())) {
                        $_SESSION['usersession'] = "coursechk" . $users->getId();
                        $_SESSION['user_id'] = $users->getId();
                        $_SESSION['user_type'] = $users->getUserType();
                    } else {
                        self::createNotif("Incorrect username and password", 0);
                    }
                } else {
                    self::createNotif("Incorrect username and password", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/login/admin");
    }

    public static function create()
    {
        // Your code here
    }
    public static function edit()
    {
        // Your edit code goes here
    }
    public static function save()
    {
        // Your save code goes here
    }

    public static function confirm()
    {
        // Your code goes here
    }
    public static function delete()
    {
        //your delete code goes here
    }
}
