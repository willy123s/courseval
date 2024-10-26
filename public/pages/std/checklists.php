<?php

use Makkari\Controllers\Grades;

require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .thick-black-border {
            border: 1px solid black;
            border-collapse: separate;
            border-spacing: 0;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            text-align: center;
            background-color: #f1f5f9;
            color: #1e293b;
        }

        .no-grades {
            background-color: yellow;
        }

        .bg-accent {
            background-color: #e5e7eb;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.3s ease-in-out;
        }

        .btn-success {
            background-color: #16a34a;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #15803d;
        }

        .btn-primary {
            background-color: #2563eb;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #1e40af;
        }
    </style>
</head>

<body>
<div class="px-8">
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
        <h2 class="text-xl font-bold"><?= $curriculum->getName() ?></h2>
        <p><?= $curriculum->getCourse()->getDescription() ?></p>
        <p>
            <?php 
            $syDet = $curriculum->getSyDet(); 
            if ($syDet) {
                echo $syDet->getSchoolyear();
            } else {
                echo "School year not available";
            }
            ?>
        </p>
    </div>
    <?php
    foreach ($yearlevels as $year) :
        $y = $year['yearlevels'];
        $s = $year['subjects'];
    ?>
        <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
            <h2 class="text-3xl font-black text-slate-700 mb-6"><?= $y->getYear() ?></h2>

            <?php
            foreach ($semesters as $ssem) {
            ?>
                <h2 class="font-bold text-lg mb-2"><?= $ssem->getSem() ?></h2>
                <table class="w-full border border-slate-700/10 mb-4">
                    <thead>
                        <tr class="bg-accent/20 text-left">
                            <th class="px-2 py-3 w-32">Code #</th>
                            <th class="px-2 py-3 w-96">Description</th>
                            <th class="px-2 py-3">Units</th>
                            <th class="px-2 py-3">Semester</th>
                            <th class="px-2 py-3">Pre requisite</th>
                            <th class="px-2 py-3">Grade</th>
                            <!-- <th class="px-2 py-3">Action</th> -->
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/10" id="tableBody">
                        <?php
                        if (sizeof($s) == 0) :
                            echo "<tr>";
                            echo "<td colspan='4' class='px-2 py-3 text-red'>No Record(s) Found</td>";
                            echo "</tr>";
                        endif;
                        foreach ($s as $subject) :
                            $grade = $subject->getGradesByStudent($_SESSION['user_id']);
                            $grades = array();
                            $iscofirmed = 2;
                            if (!empty($grade)) {
                                foreach ($grade as $g) {
                                    $grades[] = $g->getGrade();
                                    $iscofirmed = $g->getIsConfirmed();
                                }
                            } else {
                                $iscofirmed = 2;
                            }

                            $prereq = $subject->getPreReqs();
                            $prereqs = [];
                            foreach ($prereq as $pp) {
                                $prereqs[] = $pp->getCode();
                            }
                            if ($subject->getSem()->getId() == $ssem->getId()) {
                        ?>
                                <tr class="transition-all <?= empty($grades) ? 'no-grades' : '' ?>">
                                    <td class="px-2 py-3">
                                        <?= $subject->getSubject() ? $subject->getSubject()->getSubjectCode() : 'N/A' ?>
                                    </td>
                                    <td class="px-2 py-3">
                                        <?= $subject->getSubject() ? $subject->getSubject()->getDescription() : 'N/A' ?>
                                    </td>
                                    <td class="px-2 py-3">
                                        <?= $subject->getSubject() ? $subject->getSubject()->getUnits() : 'N/A' ?>
                                    </td>
                                    <td class="px-2 py-3"><?= $subject->getSem()->getSem() ?></td>
                                    <td class="px-2 py-3">
                                        <?= implode(", ", $prereqs); ?>
                                    </td>
                                    <td class="px-2 py-3"><?= implode(" / ", $grades) ?></td>
                                    <!-- <td class="px-2 py-3 flex flex-row item-center gap-2">
                                        <a href="/grades/viewgrades/<?= $subject->getId() ?>" title="View Grades" class="bg-success hover:bg-success-dark transition-all text-slate-200 p-1 rounded-md">
                                            View Grades
                                        </a>
                                        <?php
                                        $g = true;
                                        if (is_array($grade) and (sizeof($grade) != 0)) {
                                            $g = end($grade)->getGrade() > 3;
                                        }
                                        if ($iscofirmed != 1 or $g) {
                                        ?>
                                            <a href="#" title="Add Grades" data-remote="/grades/create/<?= $subject->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-brand-dark hover:bg-brand-light transition-all text-slate-200 p-1 rounded-md">
                                                Add Grades
                                            </a>
                                        <?php } ?>
                                    </td> -->
                                </tr>
                        <?php
                            }
                        endforeach;
                        ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    <?php
    endforeach;
    ?>
</div>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?> 
