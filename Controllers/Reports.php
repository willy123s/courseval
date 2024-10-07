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

        // Header
        $pdf->SetFont('Helvetica', "B", 16);
        $pdf->Cell(190, 8, "Pangasinan State University", 0, 1, 'C', false, '');

        $pdf->SetFont('Helvetica', "B", 18);
        $pdf->Cell(190, 8, "Bachelor of Science Information and Technology", 0, 1, 'C', false, '');

        $pdf->SetFont('Helvetica', "I", 14);
        $pdf->Cell(190, 8, "San Carlos City Campus", 0, 1, 'C', false, '');

        $pdf->SetFont('Helvetica', "", 14);
        $pdf->Cell(190, 8, "San Carlos, Pangasinan", 0, 1, 'C', false, '');

        $pdf->Line(10, 45, 200, 45);
        $pdf->Ln(8);

        // Student Data
        $pdf->SetFont('Helvetica', "I", 12);
        $pdf->Cell(190, 8, "as of " . date("F d, Y"), 0, 1, "C");

        $pdf->Ln(4);
        $pdf->SetFont('Helvetica', "", 12);
        $pdf->Cell(100, 5, "Name: {$userdata->getFullName()}", 0, 0);
        $pdf->Cell(90, 5, "Course: {$userdata->getCourse()->getDescription()}", 0, 1);
        $pdf->Cell(90, 5, "Curriculum: {$curriculum->getName()}", 0, 1);

        $pdf->Line(10, 80, 200, 80);

        // Table Formatting
        $pdf->SetFont('Helvetica', "B", 10);
        $pdf->SetFillColor(243, 244, 246);

        // Loop through each year level and its subjects
        foreach ($lvls as $level) {
            $y = $level['yearlevels'];
            $s = $level['subjects'];

            $pdf->Ln(5);
            $pdf->SetFont('Helvetica', "B", 10);
            $pdf->Cell(190, 5, "{$y->getYear()}", 0, 1, "", true);

            // First Semester Section
            $pdf->Ln(5);
            $pdf->SetFont('Helvetica', "B", 10);
            $pdf->Cell(190, 5, "1st Semester", 0, 1, "", true);

            $pdf->SetFont('Helvetica', "B", 10);
            $pdf->Cell(20, 6, "Code", 1, 0);
            $pdf->Cell(100, 6, "Description", 1, 0);
            $pdf->Cell(10, 6, "Unit", 1, 0);
            $pdf->Cell(20, 6, "Semester", 1, 0);
            $pdf->Cell(30, 6, "Pre-req", 1, 0);
            $pdf->Cell(10, 6, "Grade", 1, 1);

            foreach ($s as $subject) {
                if ($subject->getSem()->getSem() == "1st Semester") {
                    $grade = $subject->getGradesByStudent($userdata->getId());
                    $grades = [];
                    $isConfirmed = 2;

                    if (!empty($grade)) {
                        foreach ($grade as $g) {
                            $grades[] = $g->getGrade();
                            $isConfirmed = $g->getIsConfirmed();
                        }
                    }

                    $prereq = $subject->getPreReqs();
                    $prereqs = [];
                    foreach ($prereq as $pp) {
                        $prereqs[] = $pp->getCode();
                    }

                    $pdf->SetFillColor($isConfirmed == 2 ? 255 : 255, $isConfirmed == 2 ? 255 : 255, 0); // Yellow for missing grades

                    $pdf->SetFont('Helvetica', "", 10);
                    $pdf->Cell(20, 6, "{$subject->getSubject()->getSubjectCode()}", 1, 0, "", true);
                    $pdf->Cell(100, 6, "{$subject->getSubject()->getDescription()}", 1, 0, "", true);
                    $pdf->Cell(10, 6, "{$subject->getSubject()->getUnits()}", 1, 0, "", true);
                    $pdf->Cell(20, 6, "{$subject->getSem()->getSem()}", 1, 0, "", true);
                    $pdf->Cell(30, 6, implode(", ", $prereqs), 1, 0, "", true);
                    $pdf->Cell(10, 6, implode(" / ", $grades), 1, 1, "", true);
                }
            }

            // Second Semester Section
            $pdf->Ln(5);
            $pdf->SetFont('Helvetica', "B", 10);
            $pdf->Cell(190, 5, "2nd Semester", 0, 1, "", true);

            $pdf->SetFont('Helvetica', "B", 10);
            $pdf->Cell(20, 6, "Code", 1, 0);
            $pdf->Cell(100, 6, "Description", 1, 0);
            $pdf->Cell(10, 6, "Unit", 1, 0);
            $pdf->Cell(20, 6, "Semester", 1, 0);
            $pdf->Cell(30, 6, "Pre-req", 1, 0);
            $pdf->Cell(10, 6, "Grade", 1, 1);

            foreach ($s as $subject) {
                if ($subject->getSem()->getSem() == "2nd Semester") {
                    $grade = $subject->getGradesByStudent($userdata->getId());
                    $grades = [];
                    $isConfirmed = 2;

                    if (!empty($grade)) {
                        foreach ($grade as $g) {
                            $grades[] = $g->getGrade();
                            $isConfirmed = $g->getIsConfirmed();
                        }
                    }

                    $prereq = $subject->getPreReqs();
                    $prereqs = [];
                    foreach ($prereq as $pp) {
                        $prereqs[] = $pp->getCode();
                    }

                    $pdf->SetFillColor($isConfirmed == 2 ? 255 : 255, $isConfirmed == 2 ? 255 : 255, 0); // Yellow for missing grades

                    $pdf->SetFont('Helvetica', "", 10);
                    $pdf->Cell(20, 6, "{$subject->getSubject()->getSubjectCode()}", 1, 0, "", true);
                    $pdf->Cell(100, 6, "{$subject->getSubject()->getDescription()}", 1, 0, "", true);
                    $pdf->Cell(10, 6, "{$subject->getSubject()->getUnits()}", 1, 0, "", true);
                    $pdf->Cell(20, 6, "{$subject->getSem()->getSem()}", 1, 0, "", true);
                    $pdf->Cell(30, 6, implode(", ", $prereqs), 1, 0, "", true);
                    $pdf->Cell(10, 6, implode(" / ", $grades), 1, 1, "", true);
                }
            }
        }

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
