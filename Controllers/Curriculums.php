<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Cours;
use Makkari\Models\Curriculum;
use Makkari\Models\Curriculumdetail;
use Makkari\Models\Schoolyear;
use Makkari\Models\Semester;
use Makkari\Models\Subject;
use Makkari\Models\Yearlevel;

class Curriculums extends Controller
{
    public static function index()
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/curriculums");
            $data = array(
                "curriculums" => Curriculum::getAll(),

            );
            $view->render("curriculumview", $data);
        }
    }
    public static function create()
    {
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/curriculums");
            $data = array(
                "courses" => Cours::getAll(),
                "schoolyear" => Schoolyear::getAll()
            );
            $view->render("addCurr", $data);
        }
    }
    public static function edit($id)
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/curriculums");
            $curr = Curriculum::getById($id);
            if ($curr != NULL) {
                $data = array(
                    "curr" => $curr,
                    "courses" => Cours::getAll(),
                    "schoolyear" => Schoolyear::getAll()
                );
                $view->render("editCurr", $data);
            }
        }
    }
    public static function save()
    {
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => NULL,
                "name" => self::clean($_POST['currname']),
                "course_id" => self::clean($_POST['course']),
                "sy" => self::clean($_POST['sy']),
            );

            $ruleset = array(
                "name" => ['required'],
                "course_id" => ['required'],
                "sy" => ['required'],
            );

            $validate = Validations::validateData($data, $ruleset);
            if (empty($validate->errors)) {
                $curr = new Curriculum(...$data);
                $r = $curr->save();
                if ($r->stmt->rowCount()) {
                    self::createNotif("New curriculum created.", 1);
                    Redirect::to("/curriculums/details/{$r->lastInsertId}");
                } else {
                    self::createNotif("Something went wrong. Please try again.", 0);
                    Redirect::to("/curriculums");
                }
            } else {
                self::createNotif($validate->showErrors, 0);
                Redirect::to("/curriculums");
            }
        } else {
            Redirect::to("/curriculums");
        }
    }

    public static function details($id)
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/curriculums");
            $subjects = [];
            $lvls = [];
            $det = [];
            $levels = Yearlevel::getAll();
            foreach ($levels as $level) {
                $subs = Curriculumdetail::getByCurrIdLevel($id, $level->getId());
                array_push($lvls, array("yearlevels" => $level, "subjects" => $subs));
            }
            // var_dump($lvls[0]['subjects']);
            // header("Content-type: application/json");
            // echo json_encode($lvls);

            $data = array(
                "curriculum" => Curriculum::getById($id),
                "yearlevels" => $lvls
            );
            $view->render("detailsview", $data);
        }
    }
    public static function update()
    {
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => self::clean($_POST['id']),
                "name" => self::clean($_POST['currname']),
                "course_id" => self::clean($_POST['course']),
                "sy" => self::clean($_POST['sy']),
            );

            $ruleset = array(
                "name" => ['required'],
                "course_id" => ['required'],
                "sy" => ['required'],
            );

            $validate = Validations::validateData($data, $ruleset);
            if (empty($validate->errors)) {
                $curr = Curriculum::getById($data['id']);
                $curr->setName($data['name']);
                $curr->setCourse_id($data['course_id']);
                $curr->setSy($data['sy']);

                $r = $curr->save();
                if ($r) {
                    self::createNotif("New curriculum created.", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again.", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/curriculums/details/{$data['id']}");
    }

    public static function confirm($id)
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/confirm");
            $data = array(
                "target" => "curriculums",
                "id" => $id,
            );
            $view->render("confirm", $data);
        }
    }
    public static function remove()
    {
        if (self::post() and self::verifyRequest()) {
            $curr = Curriculum::getById($_POST['id']);

            if ($curr->remove()) {
                self::createNotif("Curriculum has been deleted.", 1);
            } else {
                self::createNotif("Something went wrong. Please try again", 0);
            }
        }
        Redirect::to("/curriculums");
    }

    public static function addsubject($curr, $yrlvl)
    {
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/curriculums");
            $data = array(
                "curr" => $curr,
                "yrlvl" => $yrlvl,
                "semesters" => Semester::getAll(),
                "subjects" => Subject::getAllButNotIn($curr),
            );
            $view->render("addSubjects", $data);
        }
    }
    public static function savesubject()
    {
        if (self::post() and self::verifyRequest()) {
            foreach ($_POST['subject'] as $sub) {
                $data = array(
                    "id" => NULL,
                    "currId" => self::clean($_POST['currId']),
                    "subId" => $sub,
                    "yearId" => $_POST['yrlvl'],
                    "semId" => $_POST['semester'],
                );
                $curriculumdetails = new Curriculumdetail(...$data);
                if ($curriculumdetails->save()) {
                    self::createNotif("New curriculum created.", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again.", 1);
                    exit();
                }
            }
        }
        Redirect::to("/curriculums/details/{$_POST['yrlvl']}");
    }
}
