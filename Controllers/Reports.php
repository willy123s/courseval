<?php

namespace Makkari\Controllers;

use FPDF;
use Makkari\Controllers\Controller;
use Makkari\Models\Curriculum;
use Makkari\Models\Curriculumdetail;
use Makkari\Models\Student;
use Makkari\Models\Yearlevel;

require_once("./Helpers/fpdf186/fpdf.php");
class Reports extends Controller
{
    public static function studGrades($studno)
    {
        $userdata = Student::getByStudNo(self::clean($studno));

        $curriculum = Curriculum::getById($userdata->getCurrId());
        $levels = Yearlevel::getAll();
        $lvls = [];
        foreach ($levels as $level) {
            $subs = Curriculumdetail::getByCurrIdLevel($userdata->getCurrId(), $level->getId());
            array_push($lvls, array("yearlevels" => $level, "subjects" => $subs));
        }

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Helvetica', "", 15);
        $pdf->Cell(190, 8, "Pangasinan State University", 0, 1, 'C', false, '');

        $pdf->SetFont('Helvetica', "B", 16);
        $pdf->Cell(190, 8, "College of Arts Sciences and Technology", 0, 1, 'C', false, '');

        $pdf->SetFont('Helvetica', "i", 14);
        $pdf->Cell(190, 8, "San Carlos City Campus", 0, 1, 'C', false, '');

        $pdf->SetFont('Helvetica', "", 14);
        $pdf->Cell(190, 8, "San Carlos, Pangasinan", 0, 1, 'C', false, '');

        $pdf->SetFont('Helvetica', "", 14);

        $pdf->Line(10, 45, 200, 45);
        $pdf->Ln(8);

        // Student Data
        $data = array(
            "user" => $userdata,
            "curriculum" => $curriculum,
            "yearlevels" => $lvls,
        );
        $pdf->SetFont('Helvetica', "i", 12);
        $pdf->Cell(190, 8, "as of" . date("F d, Y"), 0, 1, "C");

        $pdf->Ln(4);
        $pdf->SetFont('Helvetica', "", 12);
        $pdf->Cell(100, 5, "Name: {$userdata->getFullName()}", 0, 0);
        $pdf->Cell(90, 5, "Course: {$userdata->getCourse()->getDescription()}", 0, 1);
        $pdf->Cell(90, 5, "Curriculum: {$curriculum->getName()}", 0, 1);

        $pdf->Line(10, 80, 200, 80);


        $pdf->SetFont('Helvetica', "", 8);
        $pdf->SetFillColor(243, 244, 246);
        foreach ($lvls as $level) {
            $y = $level['yearlevels'];
            $s = $level['subjects'];

            $pdf->Ln(5);
            $pdf->Cell(190, 5, "{$y->getYear()}", 0, 1, "", true);

            $pdf->Cell(20, 5, "code", 1, 0);
            $pdf->Cell(100, 5, "Description", 1, 0);
            $pdf->Cell(10, 5, "Unit", 1, 0);
            $pdf->Cell(20, 5, "Semester", 1, 0);
            $pdf->Cell(30, 5, "Pre-req", 1, 0);
            $pdf->Cell(10, 5, "Grade", 1, 1);

            foreach ($s as $subject) {
                $grade = $subject->getGradesByStudent($userdata->getId());

                $grades = array();
                $iscofirmed = 2;
                if (!empty($grade)) {
                    foreach ($grade as $g) {
                        $grades[] = $g->getGrade();
                        $isConfirmed = $g->getIsConfirmed();
                    }
                } else {
                    $isConfirmed = 2;
                }

                $prereq = $subject->getPreReqs();
                $prereqs = [];
                foreach ($prereq as $pp) {
                    $prereqs[] = $pp->getCode();
                }

                $pdf->Cell(20, 5, "{$subject->getSubject()->getSubjectCode()}", 1, 0);
                $pdf->Cell(100, 5, "{$subject->getSubject()->getDescription()}", 1, 0, "");
                $pdf->Cell(10, 5, "{$subject->getSubject()->getUnits()}", 1, 0);
                $pdf->Cell(20, 5, "{$subject->getSem()->getSem()}", 1, 0);
                $pdf->Cell(30, 5, implode(", ", $prereqs), 1, 0);
                $pdf->Cell(10, 5, implode(" / ", $grades), 1, 1);
            }
        }


        // Grades
        $pdf->Output();
    }

    public static function grades($studno)
    {
        if (self::get()) {
            $userdata = Student::getByStudNo(self::clean($studno));

            $curriculum = Curriculum::getById($userdata->getCurrId());
            $levels = Yearlevel::getAll();
            $lvls = [];
            foreach ($levels as $level) {
                $subs = Curriculumdetail::getByCurrIdLevel($userdata->getCurrId(), $level->getId());
                array_push($lvls, array("yearlevels" => $level, "subjects" => $subs));
            }


            foreach ($lvls as $level) {
                $y = $level['yearlevels'];
                $s = $level['subjects'];
                foreach ($s as $subject) {
                    $grade = $subject->getGradesByStudent($userdata->getId());

                    $grades = array();
                    $iscofirmed = 2;
                    if (!empty($grade)) {
                        foreach ($grade as $g) {
                            $grades[] = $g->getGrade();
                            $isConfirmed = $g->getIsConfirmed();
                        }
                    } else {
                        $isConfirmed = 2;
                    }

                    $prereq = $subject->getPreReqs();
                    $prereqs = [];
                    foreach ($prereq as $pp) {
                        $prereqs[] = $pp->getCode();
                    }
                }
            }
        }
    }
}
