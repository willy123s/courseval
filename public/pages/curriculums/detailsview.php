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
                    ?>
                        <tr class="transition-all">
                            <td class="px-2 py-3"><?= $subject->getSubject()->getSubjectCode() ?></td>
                            <td class="px-2 py-3"><?= $subject->getSubject()->getDescription() ?></td>
                            <td class="px-2 py-3"><?= $subject->getSubject()->getUnits() ?></td>
                            <td class="px-2 py-3"><?= $subject->getSem()->getSem() ?></td>
                            <td class="px-2 py-3 flex flex-row item-center gap-2">
                                <a href="#" data-remote="/subjects/edit/<?= $subject->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-brand-dark hover:bg-brand-light transition-all text-slate-200 px-2 py-1 rounded-md">Edit</a>
                                <a href="#" data-remote="/subjects/confirm/<?= $subject->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-danger-light hover:bg-danger transition-all text-slate-50 px-2 py-1 rounded-md">Delete</a>
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