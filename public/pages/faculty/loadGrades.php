<?php

?>
<div class="bg-white/60 backdrop-blur-md sticky top-20 p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
    <h2 class="text-xl font-bold"><?= $curriculum->getName() ?></h2>
    <p><?= $curriculum->getCourse()->getDescription() ?></p>
    <p><?= $curriculum->getSyDet()->getSchoolyear() ?></p>
</div>
<?php
foreach ($yearlevels as $year) :
    $y = $year['yearlevels'];
    $s = $year['subjects'];


?>
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
        <h2 class="text-lg text-slate-700 mb-6"><?= $y->getYear() ?></h2>


        <table class="w-full border border-slate-700/10 mb-2">
            <thead>
                <tr class="bg-accent/20 text-left ">
                    <th class="px-2 py-3">Code #</th>
                    <th class="px-2 py-3">Description</th>
                    <th class="px-2 py-3">Units</th>
                    <th class="px-2 py-3">Semester</th>
                    <th class="px-2 py-3">Pre-req</th>
                    <th class="px-2 py-3">Grade</th>
                    <th class="px-2 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700/10 " id="tableBody">
                <?php

                if (sizeof($s) == 0) :
                    echo "<tr>";
                    echo "<td colspan='4' class='px-2 py-3 text-red'>No Record(s) Found</td>";
                    echo "</tr>";
                endif;
                foreach ($s as $subject) :
                    $grade = $subject->getGradesByStudent($user->getId());
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

                ?>
                    <tr class="transition-all">
                        <td class="px-2 py-3"><?= $subject->getSubject()->getSubjectCode() ?></td>
                        <td class="px-2 py-3"><?= $subject->getSubject()->getDescription() ?></td>
                        <td class="px-2 py-3"><?= $subject->getSubject()->getUnits() ?></td>
                        <td class="px-2 py-3"><?= $subject->getSem()->getSem() ?></td>
                        <td class="px-2 py-3">
                            <?= implode(", ", $prereqs); ?>
                        </td>
                        <td class="px-2 py-3"><?= implode(" / ", $grades) ?></td>
                        <td class="px-2 py-3 flex flex-row item-center gap-2">
                            <a href="/studentgrades/viewgrades/<?= $user->getId() ?>/<?= $subject->getId() ?>" title="View Grade(s)" class="bg-success hover:bg-success-dark transition-all text-slate-200 p-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                            <a href="#" title="Add Grade" data-remote="/grades/create/<?= $subject->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-brand-dark hover:bg-brand-light transition-all text-slate-200 p-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                            </a>
                            <?php

                            if ($isConfirmed == 0) {
                            ?>

                                <a href="#" title="Confirm Grade" data-remote="/grades/accept/<?= $user->getId() ?>/<?= $subject->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-success-light hover:bg-success transition-all text-slate-200 p-2 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
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
<?php
endforeach;

?>