<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;
use Makkari\Models\Curriculum;
use Makkari\Models\Curriculumdetail;
use Makkari\Models\Semester;
use Makkari\Models\Yearlevel;

class MyCurriculums extends Controller
{
    public static function index()
    {
        self::checkAuth();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/std");
            $userdata = self::usersData($_SESSION['user_id']);
            $curriculum = Curriculum::getById($userdata->getCurrId());
            $levels = Yearlevel::getAll();
            $lvls = [];
            foreach ($levels as $level) {
                $subs = Curriculumdetail::getByCurrIdLevel($userdata->getCurrId(), $level->getId());
                array_push($lvls, array("yearlevels" => $level, "subjects" => $subs));
            }
            $data = array(
                "pageTitle" => "My Curriculum / Grades",
                "pageDesc" => "View curriculum and add grades",
                "userdata" => $userdata,
                "curriculum" => $curriculum,
                "yearlevels" => $lvls,
                "semesters" => Semester::getAll()
            );
            $view->render("checklists", $data);
        }
    }
}
