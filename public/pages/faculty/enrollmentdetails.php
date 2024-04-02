<?php

use Makkari\Controllers\Grades;

require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
?>
<div class="px-8 ">

    <div class=" flex flex-col gap-4 p-6 bg-white shadow-lg shadow-black/5 rounded-lg">
        <h2 class="text-xl font-semibold ">Student Information</h2>
        <div>
            <h2 class="text-2xl font-bold" id="studno" data-studno="<?= $student->getStudNo() ?>"><?= $student->getStudNo() ?></h2>
            <h2 class="text-xl font-semibold"><?= $student->getFullName() ?></h2>
            <p><?= $student->getCourse()->getDescription() ?></p>
        </div>

    </div>
</div>
<div class="px-8 gap-4">
    <div class="">
        <?php
        if ($endetails->getStatus() == "Pending") {
        ?>
            <div class="bg-white flex flex-row gap-4 p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
                <div class="w-96 shrink-0">
                    <div class="relative mb-6">
                        <select name="year" id="year" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent">
                            <?php
                            foreach ($yearlevels as $yearlevel) {
                                echo "<option value='{$yearlevel->getId()}'>{$yearlevel->getYear()}</option>";
                            }
                            ?>

                        </select>
                        <label for="year" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Year Level <span class="text-danger">*</span></label>
                    </div>
                    <div class="relative mb-6">
                        <select name="year" id="sem" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent">
                            <?php
                            foreach ($semesters as $semester) {
                                echo "<option value='{$semester->getId()}'>{$semester->getSem()}</option>";
                            }
                            ?>
                        </select>
                        <label for="year" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Grade <span class="text-danger">*</span></label>
                    </div>

                    <button id="loadSubjects" class="w-full bg-brand hover:bg-brand-dark transition-all rounded-md px-3 py-2 text-sm text-stone-50">Load Subjects</button>

                </div>
                <div class="flex-auto" id="itemContainer">

                </div>
            </div>
        <?php } ?>
        <div class="bg-white flex flex-col gap-4 p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
            <div class="flex flex-row justify-between items-center">
                <h2 class="text-lg font-semibold">Subjects to enroll for</h2>
                <div class="flex flex-row gap-2 items-center">
                    <p class="px-2 py-1 text-sm rounded-md bg-slate-100"><?= $endetails->getStatus() ?></p>
                    <?php
                    if ($endetails->getStatus() == "Pending") {
                    ?>
                        <a href="#" data-remote="/preenroll/finalize/<?= $endetails->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-brand hover:bg-brand-dark transition-all rounded-md px-2 py-1 text-sm text-stone-50">Finalize</a>
                    <?php } ?>
                </div>
            </div>

            <div id="enrollid" data-value="<?= $endetails->getId() ?>">
                <h2>School Year: <span class="font-semibold"> <?= $endetails->getSchoolYear()->getSchoolYear() ?></span></h2>
                <p>Semester: <span class="font-semibold"><?= $endetails->getSem()->getSem() ?></span></p>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="bg-accent/50">
                        <th class="px-2 py-1 text-left">Code</th>
                        <th class="px-2 py-1 text-left">Description</th>
                        <th class="px-2 py-1 text-left">Unit</th>
                        <th class="px-2 py-1 text-left">Remarks</th>
                        <th class="px-2 py-1 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $details = $endetails->getDetails();
                    $total = 0;
                    foreach ($details as $detail) {
                        $subject = $detail->getCurr()->getSubject();
                        $total += $subject->getUnits();
                    ?>
                        <tr class="even:bg-slate-50">
                            <td class="px-2 py-1"><?= $subject->getSubjectCode() ?></td>
                            <td class="px-2 py-1"><?= $subject->getDescription() ?></td>
                            <td class="px-2 py-1"><?= $subject->getUnits() ?></td>
                            <td class="px-2 py-1 text-sm">Added By: <?= $detail->getUser()->getFullName() ?></td>
                            <td class="px-2 py-1">
                                <?php
                                if ($endetails->getStatus() == "Pending") :
                                ?>
                                    <a href="#" data-remote="/preenroll/confirm/<?= $detail->getId() ?>" class="pop text-xs bg-danger text-white hover:bg-danger-dark px-2 py-1 rounded-md">
                                        Remove
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr class="bg-accent/50">
                        <td colspan="2" class="px-2 py-1 text-right font-semibold">Total Units</td>
                        <td colspan="3" class="px-2 py-1 font-semibold"><?= $total ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?>