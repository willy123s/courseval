<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Schoolyear;

class Schoolyears extends Controller
{
    public static function index()
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/schoolyear");
            $data = array(
                "pageTitle" => "School Years",
                "pageDesc" => "Manage School Year",
                "schoolyears" => Schoolyear::getAll(),
                "userdata" => self::usersData($_SESSION['user_id'])
            );
            $view->render("schoolyearview", $data);
        }
    }
    public static function create()
    {
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/schoolyear");
            $view->render("addSy");
        }
    }
    public static function edit($id)
    {
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/schoolyear");
            $sy = Schoolyear::getById($id);
            $data = array(
                "sy" => $sy
            );
            $view->render("editSy", $data);
        }
    }
    public static function save()
    {
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => NULL,
                "schoolyear" => self::clean($_POST['sy']),
                "status" => "Active"
            );
            $ruleset = array(
                "schoolyear" => ['required'],
            );
            $validate = Validations::validateData($data, $ruleset);
            if (empty($validate->errors)) {
                $update = Schoolyear::updateStatuses();
                $sy = new Schoolyear(...$data);
                if ($sy->save()) {
                    self::createNotif("New school year added", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/schoolyears",);
    }
    public static function update()
    {
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => $_POST['id'],
                "schoolyear" => self::clean($_POST['sy']),
                "status" => "Active"
            );
            $ruleset = array(
                "id" => ['required'],
                "schoolyear" => ['required'],
            );
            $validate = Validations::validateData($data, $ruleset);

            if (empty($validate->errors)) {
                $sy = Schoolyear::getById($data['id']);
                $sy->setSchoolyear($data['schoolyear']);
                if ($sy->save()) {
                    self::createNotif("Schoolyear is now updated", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/schoolyears",);
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
