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
        .bg-custom-light-blue {
    background-color: #ADD8E6; /* Light blue color */
    opacity: 0.5; /* 50% opacity */
}

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            text-align: center;
            background-color: #f1f5f9;
            color: #1e293b;
        }

        .highlight-yellow {
            background-color: yellow;
        }

        .sticky-header {
            position: sticky;
            top: 20px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid #e5e7eb;
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

        .btn-primary {
            background-color: #2563eb;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #1e40af;
        }

        .btn-success {
            background-color: #16a34a;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #15803d;
        }

        .btn-danger {
            background-color: #dc2626;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .fixed-button {
            position: fixed;
            bottom: 5px;
            right: 5px;
            background-color: #2563eb;
            color: #fff;
            border-radius: 12px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .fixed-button:hover {
            background-color: #1e40af;
        }
    </style>
</head>
<body>
<div class="flex flex-row w-full gap-4 bg-white/60 backdrop-blur-md sticky top-20 p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
    <div>
        <div class="font-bold uppercase text-brand">
            <?= $user ? $user->getFullName() : 'Unknown User' ?>
        </div>
        <h2 class="text-xl font-bold">
            <?= $curriculum ? $curriculum->getName() : 'Unknown Curriculum' ?>
        </h2>
        <p>
            <?= $curriculum && $curriculum->getCourse() ? $curriculum->getCourse()->getDescription() : 'No Course Description' ?>
        </p>
        <p>
            <?= $curriculum && $curriculum->getSyDet() ? $curriculum->getSyDet()->getSchoolyear() : 'No School Year' ?>
        </p>
    </div>
    <div class="max-h-full overflow-y-auto">
        <?php
        if ($proofs) {
            foreach ($proofs as $proof) {
                echo "<a href='#' data-remote='/proofs/v/{$proof->getId()}' class='pop bg-blue-500 text-white hover:bg-blue-600 font-semibold py-2 px-4 rounded transition-all'>Proff of Grade for SY {$proof->getSY()} {$proof->getSem()}</a>";
            }
        } else {
            echo '.';
        }
        ?>
    </div>
</div>
<?php
if ($yearlevels) {
    foreach ($yearlevels as $year) {
        $y = $year['yearlevels'];
        $s = $year['subjects'];
?>
        <div class="bg-white w-full p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
            <h2 class="text-3xl font-black text-slate-700 mb-6">
                <?= $y ? $y->getYear() : 'Unknown Year' ?>
            </h2>
            <?php
            if ($semesters) {
                foreach ($semesters as $ssem) {
            ?>
                    <h2 class="font-bold text-lg mb-2">
                        <?= $ssem ? $ssem->getSem() : 'Unknown Semester' ?>
                    </h2>
                    <table class="w-full border border-slate-700/10 mb-4">
                        <thead>
                            <tr class="bg-accent/20 text-left ">
                                <th class="px-2 py-3 w-32">Code #</th>
                                <th class="px-2 py-3 w-96">Description</th>
                                <th class="px-2 py-3">Units</th>
                                <th class="px-2 py-3">Pre-req</th>
                                <th class="px-2 py-3">Grade</th>
                                <th class="px-2 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/10" id="tableBody">
                            <?php
                            if (empty($s)) {
                                echo "<tr>";
                                echo "<td colspan='6' class='px-2 py-3 text-red'>No Record(s) Found</td>";
                                echo "</tr>";
                            } else {
                                foreach ($s as $subject) {
                                    $grade = $subject->getGradesByStudent($user ? $user->getId() : null);
                                    $grades = [];
                                    $isConfirmed = 2;
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

                                    $sem = $subject->getSem() ? $subject->getSem()->getSem() : 'Unknown Semester';
                                    $rowClass = empty($grades) ? 'highlight-yellow' : ''; // Apply class if no grades

                                    if ($subject->getSem() && $subject->getSem()->getId() == $ssem->getId()) {
                            ?>
                                        <tr class="transition-all <?= $rowClass ?>">
                                            <td class="px-2 py-3"><?= $subject->getSubject() ? $subject->getSubject()->getSubjectCode() : 'Unknown Code' ?></td>
                                            <td class="px-2 py-3"><?= $subject->getSubject() ? $subject->getSubject()->getDescription() : 'No Description' ?></td>
                                            <td class="px-2 py-3"><?= $subject->getSubject() ? $subject->getSubject()->getUnits() : 'No Units' ?></td>
                                            <td class="px-2 py-3"><?= implode(", ", $prereqs); ?></td>
                                            <td class="px-2 py-3"><?= implode(" / ", $grades) ?></td>
                                            <td class="px-2 py-3 flex flex-row item-center gap-2">
                                                <a href="/studentgrades/viewgrades/<?= $user ? $user->getId() : '' ?>/<?= $subject->getId() ?>" title="View Grade(s)" class="bg-success hover:bg-success-dark transition-all text-slate-200 p-1 rounded-md">
                                                    View 
                                                </a>
                                                <a href="#" title="Add Grade" data-remote="/grades/create/<?= $subject->getId() . "/" . ($user ? $user->getId() : '') ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-brand-dark hover:bg-brand-light transition-all text-slate-200 p-1 rounded-md">
                                                    Add Grade
                                                </a>
                                                <?php if ($isConfirmed == 0) { ?>
                                                    <a href="#" title="Finalize Grade" data-remote="/grades/accept/<?= $user ? $user->getId() : '' ?>/<?= $subject->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-success-light hover:bg-success transition-all text-slate-200 p-1 rounded-md">
                                                        Finalize 
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
            <?php
                }
            }
            ?>
        </div>
<?php
    }
}
?>
<div class="fixed flex flex-row bottom-5 right-5 bg-brand rounded-xl text-slate-50 px-4 py-2 overflow-hidden">
    <a href="/reports/studgrades/<?= $user ? $user->getStudNo() : '' ?>" target="_blank" class="flex flex-row items-center group">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
        </svg>
        <span class="hidden relative group-hover:block">Print</span>
    </a>
</div>
</body>
</html>
