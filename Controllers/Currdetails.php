<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Controllers\Controller;
use Makkari\Models\Curriculumdetail;

class Currdetails extends Controller
{

    public static function confirm($id)
    {
        if (self::get()) {
            self::csrfToken();
            $view = new View(PAGES_PATH . "/confirm");
            $curdet = Curriculumdetail::getById($id);
            if ($curdet) {
                $data = array(
                    "target" => "currdetails",
                    "id" => $curdet->getId()
                );
                $view->render("confirm", $data);
            }
        }
    }
    public static function remove()
    {
        $l = NULL;
        if (self::post() and self::verifyRequest()) {
            $curdet = Curriculumdetail::getById($_POST['id']);
            $l = $curdet->getCurrId();
            if ($curdet) {
                if ($curdet->remove()) {
                    self::createNotif("Subject has been removed", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again.", 1);
                }
            } else {
                self::createNotif("Something went wrong. Please try again.", 1);
            }
        } else {
            self::createNotif("Something went wrong. Please try again.", 1);
        }
        Redirect::to("/curriculums/details/{$l}");
    }
}
