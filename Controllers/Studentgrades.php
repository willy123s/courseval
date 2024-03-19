<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;
use Makkari\Models\Curriculum;
use Makkari\Models\Curriculumdetail;
use Makkari\Models\Proof;
use Makkari\Models\Schoolyear;
use Makkari\Models\Semester;
use Makkari\Models\Student;
use Makkari\Models\Yearlevel;

use function Makkari\Helpers\esc;

class Studentgrades extends Controller
{
    public static function index($st = 0)
    {
        $view = new View(PAGES_PATH . "/faculty");
        $userdata = Student::getByStudNo(self::clean($st));
        if ($userdata != NULL) {
            $curriculum = Curriculum::getById($userdata->getCurrId());
            $levels = Yearlevel::getAll();
            $lvls = [];
            foreach ($levels as $level) {
                $subs = Curriculumdetail::getByCurrIdLevel($userdata->getCurrId(), $level->getId());
                array_push($lvls, array("yearlevels" => $level, "subjects" => $subs));
            }

            $data = array(
                "pageTitle" => "Student Grades",
                "pageDesc" => "Confirm or Add Grades of Student",
                "userdata" => self::usersData($_SESSION['user_id']),
                "user" => $userdata,
                "curriculum" => $curriculum,
                "yearlevels" => $lvls,
            );
        } else {
            $data = array(
                "pageTitle" => "Student Grades",
                "pageDesc" => "Confirm or Add Grades of Student",
                "userdata" => self::usersData($_SESSION['user_id']),
            );
        }
        $view->render("gradesview", $data);
    }
    public static function load()
    {
        self::checkAuth();
        if (self::post()) {
            $view = new View(PAGES_PATH . "/faculty");
            $userdata = Student::getByStudNo(self::clean($_POST['studno']));
            if ($userdata != NULL) {
                $curriculum = Curriculum::getById($userdata->getCurrId());
                $levels = Yearlevel::getAll();
                $lvls = [];
                foreach ($levels as $level) {
                    $subs = Curriculumdetail::getByCurrIdLevel($userdata->getCurrId(), $level->getId());
                    array_push($lvls, array("yearlevels" => $level, "subjects" => $subs));
                }
                $data = array(
                    "user" => $userdata,
                    "curriculum" => $curriculum,
                    "yearlevels" => $lvls,
                    "proofs" => Proof::getByUserId($userdata->getId())
                );
                $view->render("loadGrades", $data);
            } else {
                echo "<span class='text-danger text-lg'>No Records Found for " . self::clean($_POST['studno']) . "</span>";
            }
        }
    }

    public static function viewGrades($student, $curdetid)
    {
        if (self::get()) {
            $userdata = Student::getById($student);
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
