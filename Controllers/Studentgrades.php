<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;
use Makkari\Models\Curriculum;
use Makkari\Models\Curriculumdetail;
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
                "userdata" => self::usersData($_SESSION['user_id']),
                "user" => $userdata,
                "curriculum" => $curriculum,
                "yearlevels" => $lvls,
            );
        } else {
            $data = array(
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
                );
                $view->render("loadGrades", $data);
            } else {
                echo "<span class='text-danger text-lg'>No Records Found for " . self::clean($_POST['studno']) . "</span>";
            }
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
