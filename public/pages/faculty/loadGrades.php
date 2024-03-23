<?php

?>
<div class="flex flex-row w-full gap-4 bg-white/60 backdrop-blur-md sticky top-20 p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
    <div>
        <div class="font-bold uppercase text-brand"><?= $user->getFullName() ?></div>
        <h2 class="text-xl font-bold"><?= $curriculum->getName() ?></h2>
        <p><?= $curriculum->getCourse()->getDescription() ?></p>
        <p><?= $curriculum->getSyDet()->getSchoolyear() ?></p>
    </div>
    <div class="max-h-full overflow-y-auto">
        <?php
        foreach ($proofs as $proof) {
            echo "<a href='#' data-remote='/proofs/v/{$proof->getId()}' class='pop hover:text-blue-500 hover:underline' >Grade for SY {$proof->getSY()} {$proof->getSem()}</a>";
        }
        ?>
    </div>
</div>
<?php
foreach ($yearlevels as $year) :
    $y = $year['yearlevels'];
    $s = $year['subjects'];


?>
    <div class="bg-white w-full  p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
        <h2 class="text-3xl font-black text-slate-700 mb-6"><?= $y->getYear() ?></h2>

        <?php
        foreach ($semesters as $ssem) {

        ?>
            <h2 class="font-bold text-lg mb-2"><?= $ssem->getSem() ?></h2>
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

                        $sem = $subject->getSem()->getSem();
                        if ($subject->getSem()->getId() == $ssem->getId()) {

                    ?>

                            <tr class="transition-all">
                                <td class="px-2 py-3"><?= $subject->getSubject()->getSubjectCode() ?></td>
                                <td class="px-2 py-3"><?= $subject->getSubject()->getDescription() ?></td>
                                <td class="px-2 py-3"><?= $subject->getSubject()->getUnits() ?></td>

                                <td class="px-2 py-3">
                                    <?= implode(", ", $prereqs); ?>
                                </td>
                                <td class="px-2 py-3"><?= implode(" / ", $grades) ?></td>
                                <td class="px-2 py-3 flex flex-row item-center gap-2">
                                    <a href="/studentgrades/viewgrades/<?= $user->getId() ?>/<?= $subject->getId() ?>" title="View Grade(s)" class="bg-success hover:bg-success-dark transition-all text-slate-200 p-1 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                    <a href="#" title="Add Grade" data-remote="/grades/create/<?= $subject->getId() . "/" . $user->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-brand-dark hover:bg-brand-light transition-all text-slate-200 p-1 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                        </svg>
                                    </a>
                                    <?php

                                    if ($isConfirmed == 0) {
                                    ?>

                                        <a href="#" title="Confirm Grade" data-remote="/grades/accept/<?= $user->getId() ?>/<?= $subject->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-success-light hover:bg-success transition-all text-slate-200 p-1 rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                            </svg>
                                        </a>
                                    <?php } ?>

                                </td>
                            </tr>
                    <?php
                        }
                    endforeach;
                    ?>
                </tbody>
            </table>
        <?php
        } //sem foreach
        ?>
    </div>
<?php
endforeach;

?>

<div class="fixed flex flex-row bottom-5 right-5 bg-brand rounded-xl text-slate-50 px-4 py-2 overflow-hidden">
    <a href="/reports/studgrades/<?= $user->getStudNo() ?>" target="_blank" class="flex flex-row items-center group">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
        </svg>
        <span class="hidden relative group-hover:block">Print</span>
    </a>
</div>