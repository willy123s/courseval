<?php

namespace Makkari\Controllers;

use Makkari\Config\Redirect;
use Makkari\Controllers\Controller;
use Makkari\Models\Curriculumdetail;
use Makkari\Models\Enrollment;
use Makkari\Models\Enrollmentdetail;
use Makkari\Models\Schoolyear;
use Makkari\Models\Semester;
use Makkari\Models\Student;
use Makkari\Models\Yearlevel;

class Preenroll extends Controller
{
    public static function index()
    {
        self::checkAuth();
        $view = new View(PAGES_PATH . "/faculty");
        $sy = Schoolyear::getActive();
        $sem = Semester::getActive();
        $enrollment = Enrollment::getCourseCheked($sy->getId(), $sem->getId(), $_SESSION['user_id']);

        $data = array(
            "pageTitle" => "Course Check",
            "pageDesc" => "Manage Course Checking",
            "userdata" => self::usersData($_SESSION['user_id']),
            "coursechecked" => $enrollment,
        );
        $view->render("preenroll", $data);
    }
    public static function create()
    {
        self::checkAuth();
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
        self::checkAuth();
        if (self::post() and self::verifyRequest()) {
            $student = Student::getByStudNo($_POST['studno']);
            $enData = array(
                "id" => NULL,
                "studId" => $student->getId(),
                "syId" => self::clean($_POST['sy']),
                "semId" => self::clean($_POST['semester']),
                "createdBy" => $_SESSION['user_id'],
                "createdAt" => date("Y-m-d H:i:s"),
                "status" => "Pending"
            );
            $exist = Enrollment::ifExist($enData['studId'], $enData['semId'], $enData['syId']);
            if ($exist == NULL) :
                $enr = Enrollment::getPendingByStudent($enData['studId'], 'Pending');

                if ($enr == 0) {

                    $enrollment = new Enrollment(...$enData);
                    $enid = $enrollment->save();
                    if ($enid) {
                        self::createNotif("New transaction added.", 1);
                    } else {
                        self::createNotif("Something went wrong. Please try again.", 0);
                    }
                } else {
                    $enid = $enr->getId();
                }
            else :
                $enid = $exist->getId();
            endif;
            Redirect::to("/preenroll/transaction/{$_POST['studno']}/{$enid}");
        } else {
            Redirect::to("/preenroll");
        }
    }

    public static function transaction($student = 0, $enrollment)
    {
        self::checkAuth();
        if (self::get()) {
            $student = Student::getByStudNo($student);
            $view = new View(PAGES_PATH . "/faculty");

            $data = array(
                "pageTitle" => "Course Checking Details",
                "pageDesc" => "Add or Remove subject to enroll",
                "userdata" => self::usersData($_SESSION['user_id']),
                "student" => $student,
                "endetails" => Enrollment::getById($enrollment),
                "yearlevels" => Yearlevel::getAll(),
                "semesters" => Semester::getAll()
            );
            $view->render("enrollmentdetails", $data);
        }
    }
    public static function load()
    {
        self::checkAuth();
        if (self::post()) {
            if ($_SESSION['user_type'] != "Student") {
                $userdata = Student::getByStudNo($_POST['studno']);
                if ($userdata == NULL) {
                    echo "no records found for <span class='text-danger font-semibold'>" . $_POST['studno'] . "</span>";
                }
            } else {
                $userdata = self::usersData($_SESSION['user_id']);
            }
            if ($userdata != NULL) {
                $data = array(
                    "year" => $_POST['year'],
                    "sem" => $_POST['sem'],
                    "currid" => $userdata->getCurrId(),
                    "studid" => $userdata->getId()
                );

                $curr = Curriculumdetail::getCourseCheck(...$data);

                $view = new View(PAGES_PATH . "/faculty");
                $load = array(
                    "loads" => $curr,
                    "student" => $userdata,
                    "enid" => $_POST['enid']
                );
                $view->render("subjectssuggestion", $load);
            }
        }
    }
    public static function addsubjects($enrollmentid)
    {
        if (self::post()) {
            $checkboxes = $_POST['subjects'];
            $enroll = Enrollment::getById($enrollmentid);
            $student = Student::getById($enroll->getStudId());
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
                    if ($endetails->save()) {
                        self::createNotif("Subjects added", 1);
                    } else {
                        self::createNotif("Something went wrong. Please try again.", 0);
                    }
                } else {
                    self::createNotif("Subjects already exists", 0);
                }
            }
            // var_dump($e);
            Redirect::to("/preenroll/transaction/{$student->getStudNo()}/{$enrollmentid}");
        }
    }
    public static function confirm($id)
    {
        if (self::get()) {
            $data = array(
                "target" => "preenroll",
                "id" => $id
            );
            $view = new View(PAGES_PATH . "/confirm");
            $view->render("confirm", $data);
        }
    }
    public static function finalize($enid)
    {
        if (self::get()) {
            $msgbox = new Msgbox("Finalize", "Are you sure you want to finalize this preenrollment?", "preenroll/msgfinalize/", $enid);
            $msgbox->render();
        }
    }
    public static function msgfinalize()
    {
        if (self::post()) {
            $data = array(
                "id" => $_POST['id']
            );
            $enroll = Enrollment::getById($data['id']);
            $student = $enroll->getStudent();
            $enroll->setStatus("Completed");
            if ($enroll->save()) {
                self::createNotif("Enrollment is now Finalized.", 1);
            } else {
                self::createNotif("Enrollment is now Finalized.", 0);
            }
        }
        Redirect::to("/preenroll/transaction/{$student->getStudNo()}/{$enroll->getId()}");
    }
    public static function remove()
    {
        if (self::post() and self::verifyRequest()) {
            $enrolldet = Enrollmentdetail::getById($_POST['id']);
            $enroll = Enrollment::getById($enrolldet->getEnrollmentId());
            $student = Student::getById($enroll->getStudId());
            if ($enrolldet->remove()) {
                self::createNotif("Subject has been removed.", 1);
            } else {
                self::createNotif("Something went wrong. Please try again.", 0);
            }
        }
        Redirect::to("/preenroll/transaction/{$student->getStudNo()}/{$enroll->getId()}");
    }
}
