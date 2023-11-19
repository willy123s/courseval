<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;
use Makkari\Models\Enrollment;
use Makkari\Models\Enrollmentdetail;
use Makkari\Models\Student;

class Enrollments extends Controller
{
    public static function index()
    {
        // Your code here
    }
    public static function create()
    {
        if (self::post()) {
            $userdata = Student::getByStudNo($_POST['studno']);
            $checkboxes = $_POST['checkedValues'];
            $enData = array(
                "id" => NULL,
                "studId" => $userdata->getId(),
                "syId" => "",
                "semId" => "",
                "createdBy" => $_SESSION['user_id'],
                "createdAt" => date("Y-m-d, H:i:s"),
            );

            $enrollment = new Enrollment(...$enData);
            $en = $enrollment->save();
            if ($en) {
                foreach ($checkboxes as $value) {
                    $details = array(
                        "id" => NULL,
                        "enrollmentId" => $en,
                        "currDetId" => $userdata->getId(),
                        "addedBy" => $_SESSION['user_id'],
                        "addedAt" => date("Y-m-d, H:i:s"),
                    );
                    $endetails = new Enrollmentdetail(...$details);
                    $endetails->save();
                }
            }
        }
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
