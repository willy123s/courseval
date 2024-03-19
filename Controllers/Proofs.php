<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Controllers\Controller;
use Makkari\Models\Proof;
use Makkari\Models\Schoolyear;
use Makkari\Models\Semester;

use function Makkari\Helpers\uploadFile;

class Proofs extends Controller
{
    public static function index()
    {
        self::checkAuth();
        if (self::get()) {
            $view = new View(PAGES_PATH . "/proofs");
            $proofs = Proof::getAll();
            $data = array(
                "pageTitle" => "Proof of Grades",
                "pageDesc" => "Manage Proof of Grades",
                "userdata" => self::usersData($_SESSION['user_id']),
                "proofs" => $proofs
            );
            $view->render("proofs", $data);
        }
    }

    public static function create()
    {
        self::checkAuth();
        if (self::get()) {
            self::csrfToken();
            $view = new View(PAGES_PATH . "/proofs");
            $data = array(
                "schoolyear" => Schoolyear::getAll(),
                "semester" => Semester::getAll()
            );
            $view->render("newproof", $data);
        }
    }
    public static function v($id)
    {
        if (self::get() and is_numeric($id)) {
            $view = new View(PAGES_PATH . "/proofs");
            $file = Proof::getById($id);
            $data = array(
                "filepath" => $file->getFilename()
            );
            $view->render("viewfile", $data);
        }
    }

    public static function save()
    {
        if (self::post() and self::verifyRequest()) {
            $storage = './public/storage/proofs';
            $allow = ['jpg', 'png', 'bmp'];

            $result = uploadFile('filename', $storage, $allow);
            if ($result['success'] == true) {
                $data = array(
                    "id" => $_POST['id'] ?? NULL,
                    "userId" => $_SESSION['user_id'],
                    "yearid" => $_POST['yearid'],
                    "semester" => $_POST['semester'],
                    "filename" => $result['filePath']
                );
                $proof = new Proof(...$data);
                if ($proof->save()) {
                    self::createNotif($result['message'], $result['success']);
                } else {
                    self::createNotif($result['message'], $result['success']);
                }
            } else {
                self::createNotif($result['message'], $result['success']);
            }
        }
        Redirect::to("/proofs");
    }
    public static function confirm($id)
    {
        if (self::get() and is_numeric($id)) {
            $view = new View(PAGES_PATH . "/confirm");
            $proof = Proof::getById($id);
            if ($proof != NULL) {
                $data = array(
                    "target" => 'proofs',
                    "id" => $proof->getId()
                );
                $view->render('confirm', $data);
            }
        }
    }
    public static function remove()
    {
        if (self::post() and self::verifyRequest()) {

            $proof = Proof::getById($_POST['id']);
            $filePath = $proof->getFilename();
            if ($proof != NULL) {
                if ($proof->remove()) {
                    if (file_exists($filePath)) {
                        unlink($filePath); // Deletes the file
                    }
                    self::createNotif("Proof is removed", 1);
                } else {
                    self::createNotif("Something went wrong. Please try again", 0);
                }
            }
        }
        Redirect::to("/proofs");
    }
}
