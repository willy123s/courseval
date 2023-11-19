<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;
use Makkari\Models\Curriculumdetail;
use Makkari\Models\Prerequisite;

class Prerequisites extends Controller
{
    public static function index()
    {
    }
    public static function create($id)
    {
        if (self::post()) {
            $view = new View(PAGES_PATH . "/prereq");
            $view->render("addprereq");
        }
    }
    public static function edit()
    {
        // Your edit code goes here
    }
    public static function save()
    {
        if (self::post()) {
            $content = $_POST['content'];
            $currId = $_POST['curr'];
            $prereq = explode(",", $content);
            $savedpre = [];

            $result = "";

            foreach ($prereq as $pre) {
                $p = Curriculumdetail::getAllInCurr($currId, trim($pre));

                if (!empty($p)) {

                    $data = array(
                        "id" => NULL,
                        "currDetailsId" => $_POST['currdetid'],
                        "prereq" => $p[0]->getId(),
                        "type" => "Pre"
                    );

                    if (!Prerequisite::ifExists($data['currDetailsId'], $data['prereq'])) {
                        $prereq = new Prerequisite(...$data);
                        if ($prereq->save()) {
                            $savedpre[] = $pre;
                            $result = 1;
                        } else {
                            $result = 0;
                        }
                    } else {
                        $savedpre[] = $pre;
                    }
                } else {
                    $result = 2;
                    // self::createNotif("empty" . $p, 1);
                }
            }

            if ($content == "") {
                $reqs = Prerequisite::getAllByCurr($_POST['currdetid']);
                foreach ($reqs as $req) {
                    $req->remove();
                    $result = 1;
                }
            }

            $pr = implode(",", $savedpre);
            $json = array(
                "prereq" => $pr,
                "result" => $result
            );

            header("Content-type: application/json");
            echo json_encode($json);
        }
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
