<?php

use Makkari\Controllers\Grades;

require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");

$sub = $subject->getSubject();
$grades = $subject->getGradesByStudent($userdata->getId());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.thick-black-border {
    border: 1px solid black; /* Thicker border */
    border-collapse: separate; /* Separate border model to avoid double borders */
    border-spacing: 0; /* No spacing between cells */
}
th, 
td {
    border: 1px solid black; /* Thicker border for table headers and cells */
}
th {
    text-align: center; /* Center text in table headers */
    background-color: #dbeaf2; /* Light blue background for headers */
    color: #333; /* Darker text color for contrast */
}
td {
    background-color: #f0f7ff; /* Very light blue background for table cells */
}
</style>

</head>
<body>
<div class="px-8">
    <div class="py-4">
        <?php if ($_SESSION['user_type'] != 'Student') { ?>
            <a href="/studentgrades//<?= $userdata->getStudNo() ?>" class="bg-brand hover:bg-brand-dark rounded-md px-4 py-2 text-stone-50 transition-all text-sm">Back</a>
        <?php } else { ?>
            <a href="/MyCurriculums" class="bg-brand hover:bg-brand-dark rounded-md px-4 py-2 text-stone-50 transition-all text-sm">Back</a>
        <?php } ?>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
        <h2 class="font-bold text-3xl mb-2"><?= $userdata->getFullName(); ?></h2>
        <h2 class="text-xl font-bold"><?= $curriculum->getName() ?></h2>
        <p><?= $curriculum->getCourse()->getDescription() ?></p>
        <?php
        $syDet = $curriculum->getSyDet();
        if ($syDet) {
            echo '<p>' . htmlspecialchars($syDet->getSchoolyear()) . '</p>';
        } else {
            echo '<p>Schoolyear information not available</p>';
        }
        ?>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
        <div class="text-2xl font-semibold mb-4">
            <?= htmlspecialchars($sub->getSubjectCode() . " " . $sub->getDescription() . " " . $sub->getUnits()) ?>
        </div>
        <table class="w-full border border-slate-700/10 mb-2">
            <thead>
                <tr class="bg-accent/20 text-left ">
                    <th class="px-2 py-3">Grade</th>
                    <th class="px-2 py-3">Schoolyear</th>
                    <th class="px-2 py-3">Semester</th>
                    <th class="px-2 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700/10 " id="tableBody">
                <?php foreach ($grades as $grade) : ?>
                    <tr>
                        <td class="px-2 py-1"><?= htmlspecialchars($grade->getGrade()) ?></td>
                        <td class="px-2 py-1"><?= htmlspecialchars($grade->getSchoolyearInfo() ? $grade->getSchoolyearInfo()->getSchoolyear() : 'N/A') ?></td>
                        <td class="px-2 py-1"><?= htmlspecialchars($grade->getSemesterInfo() ? $grade->getSemesterInfo()->getSem() : 'N/A') ?></td>
                        <td class="px-2 py-1 flex flex-row item-center gap-2">
                            <?php if (!$grade->getIsConfirmed()) : ?>
                               <a href="#" data-remote="/grades/edit/<?= htmlspecialchars($grade->getId()) . "/" . htmlspecialchars($userdata->getId()) ?>" data-size="w-full md:w-2/5 lg:w-1/5" title="Edit Grade" class="pop bg-success hover:bg-success-dark transition-all text-slate-200 p-2 rounded-md">
    Edit Grade
</a>
<a href="#" data-remote="/grades/confirm/<?= htmlspecialchars($grade->getId()) . "/" . htmlspecialchars($userdata->getId()) ?>" data-size="w-full md:w-2/5 lg:w-1/5" title="Delete Grade" class="pop bg-danger hover:bg-danger-dark transition-all text-slate-200 p-2 rounded-md">
    Delete
</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?>
