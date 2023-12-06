<?php
require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
?>
<div class="px-8">
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
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
            <div class="mb-4">
                <a href="#" data-remote="/curriculums/addsubject/<?= "{$curriculum->getId()}/{$y->getId()}" ?>" data-size="w-full md:w-2/5" class="pop px-3 py-2 text-sm bg-brand hover:bg-brand-dark rounded-md text-slate-100 transition-all">Add Subject</a>
            </div>

            <table class="w-full border border-slate-700/10 mb-2">
                <thead>
                    <tr class="bg-accent/20 text-left ">
                        <th class="px-2 py-3">Code #</th>
                        <th class="px-2 py-3">Description</th>
                        <th class="px-2 py-3">Units</th>
                        <th class="px-2 py-3">Semester</th>
                        <th class="px-2 py-3">Co/Pre requisite</th>
                        <th class="px-2 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/10 " id="tableBody">
                    <?php

                    if (sizeof($s) == 0) :
                        echo "<tr>";
                        echo "<td colspan='6' class='px-2 py-3 text-red'>No Record(s) Found</td>";
                        echo "</tr>";
                    endif;
                    foreach ($s as $subject) :
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
                            <td class=" px-2 py-3 ">
                                <div class="prereq focus:outline-brand/60 border border-slate-700/10" data-curr="<?= $curriculum->getId() ?>" data-id="<?= $subject->getId() ?>">&nbsp;
                                    <?php
                                    echo implode(", ", $prereqs);
                                    ?>
                                </div>
                            </td>
                            <td class="px-2 py-3 flex flex-row item-center gap-2">
                                <a href="#" data-remote="/currdetails/confirm/<?= $subject->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-danger-light hover:bg-danger transition-all text-slate-50 p-1 rounded-md text-sm" title="Remove">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </a>
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


</div>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?>