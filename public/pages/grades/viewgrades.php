<?php

use Makkari\Controllers\Grades;

require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
$sub = $subject->getSubject();
$grades = $subject->getGradesByStudent($userdata->getId());
?>

<div class="px-8">
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
        <h2 class="font-bold text-3xl mb-2"><?= $userdata->getFullName(); ?></h2>
        <h2 class="text-xl font-bold"><?= $curriculum->getName() ?></h2>
        <p><?= $curriculum->getCourse()->getDescription() ?></p>
        <p><?= $curriculum->getSyDet()->getSchoolyear() ?></p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
        <div class="text-2xl font-semibold mb-4">
            <?= $sub->getSubjectCode() . " " . $sub->getDescription() . " " . $sub->getUnits() ?>
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
                <?php
                foreach ($grades as $grade) :
                    $iscofirmed = $grade->getIsConfirmed();
                ?>
                    <tr>
                        <td class="px-2 py-1"><?= $grade->getGrade() ?></td>
                        <td class="px-2 py-1"><?= $grade->getSchoolyearInfo()->getSchoolyear() ?></td>
                        <td class="px-2 py-1"><?= $grade->getSemesterInfo()->getSem() ?></td>
                        <td class="px-2 py-1 flex flex-row item-center gap-2">
                            <?php
                            if (!$iscofirmed) {
                            ?>
                                <a href="#" data-remote="/grades/edit/<?= $grade->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" title="Edit Grade" class="pop bg-success hover:bg-success-dark transition-all text-slate-200 p-2 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                                <a href="#" data-remote="/grades/confirm/<?= $grade->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" title="Edit Grade" class="pop bg-danger hover:bg-danger-dark transition-all text-slate-200 p-2 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?>