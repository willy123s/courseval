<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Controllers\Controller;
use Makkari\Models\Enrollment;
use Makkari\Models\Enrollmentdetail;
use Makkari\Models\Schoolyear;
use Makkari\Models\Semester;
use Makkari\Models\Student;

class Enrollments extends Controller
{
    public static function index()
    {
        // Your code here
    }

    public static function create()
    {
        if (self::get()) {
            $view = new View(PAGES_PATH . "/faculty");
            $data = array(
                "schoolyear" => Schoolyear::getAll(),
                "semesters" => Semester::getAll()
            );
            $view->render("newcoursecheck", $data);
        }
    }
    public static function edit()
    {
        // Your edit code goes here
    }
    public static function save()
    {
        if (self::post()) {
            $checkboxes =  $_POST['checkedValues'];
            $userdata = Student::getByStudNo($_POST['studno']);
            if ($userdata != NULL) {
                $enData = array(
                    "id" => NULL,
                    "studId" => $userdata->getId(),
                    "syId" => "",
                    "semId" => "",
                    "createdBy" => $_SESSION['user_id'],
                    "createdAt" => date("Y-m-d H:i:s"),
                    "status" => "Pending"
                );
                $enr = Enrollment::getPendingByStudent($enData['studId'], 'Pending');

                if ($enr == NULL) {
                    $enrollment = new Enrollment(...$enData);
                    $enrollmentid = $enrollment->save();
                } else {
                    $enrollmentid = $enr->getId();
                }
                foreach ($checkboxes as $value) {
                    $details = array(
                        "id" => NULL,
                        "enrollmentId" => $enrollmentid,
                        "currDetId" => $value,
                        "addedBy" => $_SESSION['user_id'],
                        "addedAt" => date("Y-m-d H:i:s"),
                    );
                    $e = Enrollmentdetail::isExist($details['enrollmentId'], $details['currDetId']);
                    if (!$e) {
                        $endetails = new Enrollmentdetail(...$details);
                        $endetails->save();
                        echo "Subjects Added";
                    } else {
                        echo "Already Exists";
                    }
                }
            } else {
                echo "Student Did not exist";
            }
            echo $e;
        }
    }
    public static function addSubjects()
    {

        $enrollmentid = $_POST['enrollmentid'];
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
