<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Department;
use Makkari\Models\User;

class Departments extends Controller
{
    public static function index()
    {
        self::checkAuth();
        $view = new View(PAGES_PATH . "/departments");
        $data = array(
            "departments" => Department::getAll(),
            "userdata" => self::usersData($_SESSION['user_id'])
        );
        $view->render("departmentsview", $data);
    }
    public static function create()
    {
        self::checkAuth();
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/departments");
            $view->render("addDepartment");
        }
    }
    public static function edit($id)
    {
        self::checkAuth();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/departments");
            $data = array(
                "department" => Department::getById($id),
            );
            $view->render("editDepartments", $data);
        }
    }
    public static function save()
    {
        self::checkAuth();
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => NULL,
                "department" => self::clean($_POST['department']),
                "description" => self::clean($_POST['description'])
            );

            $ruleset = array(
                "department" => ['required'],
                "description" => ['required'],
            );

            $validate = Validations::validateData($data, $ruleset);

            if (empty($validate->errors)) {
                $department = new Department(...$data);
                if ($department->save()) {
                    self::createNotif("New department added", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/departments");
    }

    public static function update()
    {
        self::checkAuth();
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => self::clean($_POST['id']),
                "department" => self::clean($_POST['department']),
                "description" => self::clean($_POST['description'])
            );

            $ruleset = array(
                "department" => ['required'],
                "description" => ['required'],
            );
            $validate = Validations::validateData($data, $ruleset);

            if (empty($validate->errors)) {
                $department = Department::getById($data['id']);
                $department->setDepartment($data['department']);
                $department->setDescription($data['description']);

                if ($department->save()) {
                    self::createNotif("Department is now updated", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/departments");
    }

    public static function confirm($id)
    {
        self::checkAuth();
        if (self::get()) {
            self::csrfToken();
            $department = Department::getById($id);
            $view = new View(PAGES_PATH . "/confirm");
            $data = array(
                "target" => "departments",
                "id" => $department->getId(),
            );
            $view->render("confirm", $data);
        }
    }
    public static function delete()
    {
        self::checkAuth();
        if (self::post() and self::verifyRequest()) {
            $id = self::clean($_POST['id']);
            $department = Department::getById($id);
            if ($department != NULL) {
                if ($department->remove()) {
                    self::createNotif("Department is now deleted.", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again.", 0);
                }
            }
        }
        Redirect::to("/departments");
    }
}
