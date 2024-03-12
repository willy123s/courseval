<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Config\Validations;
use Makkari\Controllers\Controller;
use Makkari\Models\Curriculum;
use Makkari\Models\Curriculumdetail;
use Makkari\Models\Grade;
use Makkari\Models\Graderange;
use Makkari\Models\Schoolyear;
use Makkari\Models\Semester;
use Makkari\Models\Student;
use Makkari\Models\Yearlevel;

class Grades extends Controller
{

    public static function create($id)
    {
        self::checkAuth();
        self::csrfToken();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/std");
            $data = array(
                "id" => $id,
                "semesters" => Semester::getAll(),
                "schoolyear" => Schoolyear::getAll(),
                "graderange" => Graderange::getAll()
            );
            $view->render("addGrade", $data);
        }
    }
    public static function viewGrades($curdetid)
    {
        if (self::get()) {
            $userdata = self::usersData($_SESSION['user_id']);
            $curriculum = Curriculum::getById($userdata->getCurrId());
            $levels = Yearlevel::getAll();
            $lvls = [];
            foreach ($levels as $level) {
                $subs = Curriculumdetail::getByCurrIdLevel($userdata->getCurrId(), $level->getId());
                array_push($lvls, array("yearlevels" => $level, "subjects" => $subs));
            }
            $currDetails = Curriculumdetail::getById($curdetid);
            // $grades = Grade::getGradeByStudentAndSubject($userdata->getId(), $curdetid);

            $view = new View(PAGES_PATH . "/grades");
            $data = array(
                "pageTitle" => "My Curriculum / Grades",
                "pageDesc" => "View curriculum and add grades",
                "userdata" => $userdata,
                "semesters" => Semester::getAll(),
                "schoolyear" => Schoolyear::getAll(),
                "curriculum" => $curriculum,
                "yearlevels" => $lvls,
                "subject" => $currDetails
            );
            $view->render("viewgrades", $data);
        }
    }
    public static function edit($id)
    {
        if (self::get()) {
            self::csrfToken();

            $grade = Grade::getById($id);
            $view = new View(PAGES_PATH . "/grades");
            $data = array(
                "grade" => $grade,
                "semesters" => Semester::getAll(),
                "schoolyear" => Schoolyear::getAll(),
                "graderange" => Graderange::getAll()
            );
            $view->render("editGrade", $data);
        }
    }
    public static function update()
    {
        $curdet = 0;
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "studId" => $_SESSION['user_id'],
                "gradeid" => $_POST['id'],
                "grade" => $_POST['grade'],
                "semester" => $_POST['semester'],
                "schoolyear" => $_POST['sy'],
                "isConfirmed" => 0,
            );
            $ruleset = array(
                "studId" => ['required'],
                "grade" => ['required'],
                "semester" => ['required'],
                "schoolyear" => ['required'],
            );
            $validate = Validations::validateData($data, $ruleset);
            if (empty($validate->errors)) {
                $grade = Grade::getById($data['gradeid']);
                $grade->setGrade($data['grade']);
                $grade->setSemester($data['semester']);
                $grade->setSchoolyear($data['schoolyear']);
                $curdet = $grade->getCurrDetailsId();
                if ($grade->save()) {
                    self::createNotif("Your grade is updated", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        if ($curdet != 0) {
            Redirect::to("/grades/viewgrades/{$curdet}");
        } else {
            Redirect::to("/grades/mycurriculums");
        }
    }
    public static function save()
    {
        if (self::post() and self::verifyRequest()) {
            $data = array(
                "id" => NULL,
                "studId" => $_SESSION['user_id'],
                "currDetailsId" => $_POST['id'],
                "grade" => $_POST['grade'],
                "semester" => $_POST['semester'],
                "schoolyear" => $_POST['sy'],
                "isConfirmed" => 0,
            );
            $ruleset = array(
                "studId" => ['required'],
                "currDetailsId" => ['required'],
                "grade" => ['required'],
                "semester" => ['required'],
                "schoolyear" => ['required'],
            );

            $validate = Validations::validateData($data, $ruleset);

            if (empty($validate->errors)) {
                $grade = new Grade(...$data);
                if ($grade->save()) {
                    self::createNotif("Your grade is saved", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 0);
                }
            } else {
                self::createNotif($validate->showErrors, 0);
            }
        }
        Redirect::to("/myCurriculums");
    }
    public static function accept($studid, $id)
    {
        self::csrfToken();
        $msgbox = new Msgbox("Confirm Grade", "Are you sure you want to confirm this grade?", "grades/msgaccept/" . $studid, $id);
        $msgbox->render();
    }
    public static function msgaccept($studid)
    {
        if (self::post() and self::verifyRequest()) {
            $student = Student::getById($studid);
            $data = array(
                "id" => $_POST['id']
            );
            $grades = Grade::getGradeByStudentAndSubject($studid, $data['id']);
            foreach ($grades as $grade) {
                $grade->setIsConfirmed(1);
                $grade->save();
            }
        }
        Redirect::to("/studentgrades//{$student->getStudNo()}");
    }
    public static function confirm($gradeid)
    {
        if (self::get()) {
            self::csrfToken();
            $view = new View(PAGES_PATH . "/confirm");
            $data = array(
                "target" => "grades",
                "id" => $gradeid,
            );
            $view->render("confirm", $data);
        }
    }
    public static function remove()
    {
        $curdet = 0;
        if (self::post() and self::verifyRequest()) {
            $grades = Grade::getById($_POST['id']);
            $curdet = $grades->getCurrDetailsId();
            if ($grades != NULL) {
                if ($grades->remove()) {
                    self::createNotif("Grade has been deleted", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 0);
                }
            } else {
                self::createNotif("Something went wrong. Please try again", 0);
            }
        } else {
            self::createNotif("Something went wrong. Please try again", 0);
        }
        if ($curdet != 0) {
            Redirect::to("/grades/viewgrades/{$curdet}");
        } else {
            Redirect::to("/grades/viewgrades/{$curdet}");
        }
    }
}
