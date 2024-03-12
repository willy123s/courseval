<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Cours;
use Makkari\Models\User;
use Makkari\Models\Usertype;

class Users extends Controller
{
    public static function index()
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/users");
            $data = array(
                "pageTitle" => "Users",
                "pageDesc" => "Manage users",
                "users" => User::getAll(),
                "userdata" => self::usersData($_SESSION['user_id'])
            );
            $view->render("usersview", $data);
        }
    }
    public static function create()
    {
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/users");
            $data = array(
                "types" => Usertype::getAll(),
                "courses" => Cours::getAll()
            );
            $view->render("addUser", $data);
        }
    }
    public static function edit($userid)
    {
        if (self::get() and is_numeric($userid)) {
            $view = new View(PAGES_PATH . "/users");
            $types = Usertype::getAll();
            $data = array(
                "user" => User::getById($userid),
                "types" => $types,
                "courses" => Cours::getAll()
            );
            $view->render("edituser", $data);
        }
    }
    public static function save()
    {
        if (self::post() and self::verifyRequest()) {
            $password = self::generatePassword(6);
            $data = array(
                "id" => $_POST['id'] ?? NULL,
                "empno" => $_POST['empno'],
                "fname" => $_POST['fname'],
                "lname" => $_POST['lname'],
                "mname" => $_POST['mname'],
                "email" => $_POST['email'],
                "password" => password_hash($password, PASSWORD_BCRYPT),
                "courseId" => $_POST['course'],
                "userType" => $_POST['userType'],
            );

            $ruleset = array(
                "empno" => ['required'],
                "fname" => ['required'],
                "lname" => ['required'],
                "email" => ['required'],
                "courseId" => ['required'],
                "userType" => ['required'],
            );

            $validate = Validations::validateData($data, $ruleset);

            if (empty($validate->errors)) {
                if ($data['id']) {
                    $user = User::getById($data['id']);
                    $user->setEmpno($data['empno']);
                    $user->setFname($data['fname']);
                    $user->setLname($data['lname']);
                    $user->setEmail($data['email']);
                    $user->setCourseId($data['courseId']);
                    $user->setUserType($data['userType']);

                    if ($user->save()) {
                        self::createNotif("User's data has been updated.", 1);
                    } else {
                        self::createNotif("Something went wrong. Please try again", 1);
                    }
                } else {
                    $user = new User(...$data);
                    if ($user->save()) {
                        self::createNotif("New user added.", 1);
                    } else {
                        self::createNotif("Something went wrong. Please try again", 1);
                    }
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/users");
    }

    public static function confirm($id)
    {
        if (self::get() and is_numeric($id)) {
            $view = new View(PAGES_PATH . "/confirm");
            self::csrfToken();
            $user = User::getById($id);
            if ($user) {
                $data = array(
                    "target" => "users",
                    "id" => $user->getId()
                );
                $view->render("confirm", $data);
            }
        }
    }
    public static function remove()
    {
        if (self::post() and self::verifyRequest()) {
            $user = User::getById($_POST['id']);
            if ($user) {
                if ($user->remove()) {
                    self::createNotif("User has been removed", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again.", 0);
                }
            } else {
                self::createNotif("Something went wrong. Please try again.", 0);
            }
        } else {
            self::createNotif("Something went wrong. Please try again.", 0);
        }

        Redirect::to("/users");
    }
}
