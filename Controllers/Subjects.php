<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Cours;
use Makkari\Models\Subject;

class Subjects extends Controller
{
    public static function index()
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/subjects");
            $data = array(
                "subjects" => Subject::getAll()
            );
            $view->render("subjectsview", $data);
        }
    }
    public static function create()
    {
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/subjects");
            $view->render("addSubject");
        }
    }
    public static function edit($id)
    {

        self::csrfToken();
        if (self::get()) {
            $subject = Subject::getById($id);
            if ($subject != NULL) {
                $data = array(
                    "subject" => $subject
                );
                $view = new View(PAGES_PATH . "/subjects");
                $view->render("editSubject", $data);
            }
        }
    }
    public static function save()
    {
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => NULL,
                "subjectCode" => self::clean($_POST['code']),
                "description" => self::clean($_POST['description']),
                "units" => self::clean($_POST['units']),
            );

            $ruleset = array(
                "subjectCode" => ['required'],
                "description" => ['required'],
                "units" => ['required'],
            );
            $validate = Validations::validateData($data, $ruleset);
            if (empty($validate->errors)) {
                $subject = new Subject(...$data);
                if ($subject->save()) {
                    self::createNotif("New subject added", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/subjects");
    }
    public static function update()
    {
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => self::clean($_POST['id']),
                "subjectCode" => self::clean($_POST['code']),
                "description" => self::clean($_POST['description']),
                "units" => self::clean($_POST['units']),
            );

            $ruleset = array(
                "subjectCode" => ['required'],
                "description" => ['required'],
                "units" => ['required'],
            );
            $validate = Validations::validateData($data, $ruleset);
            if (empty($validate->errors)) {
                $subject = Subject::getById($data['id']);
                $subject->setSubjectCode($data['subjectCode']);
                $subject->setDescription($data['description']);
                $subject->setUnits($data['units']);

                if ($subject->save()) {
                    self::createNotif("Subject is now updated.", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/subjects");
    }
    public static function confirm($id)
    {
        if (self::get()) {
            $subject = Subject::getById($id);
            $data = array(
                "target" => "subjects",
                "id" => $subject->getId()
            );
            $view = new View(PAGES_PATH . "/confirm");
            $view->render("/confirm", $data);
        }
    }
    public static function remove()
    {
        if (self::post() and self::verifyRequest()) {
            $subject = Subject::getById($_POST['id']);
            if ($subject->remove()) {
                self::createNotif("Subject is now updated.", 1);
            } else {
                self::createNotif("Something went wrong. Please try again.", 0);
            }
        }
        Redirect::to("/subjects");
    }
}
