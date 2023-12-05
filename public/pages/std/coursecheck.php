<?php

use Makkari\Controllers\Grades;

require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
?>
<div class="px-8 flex flex-row gap-6">
    <div>
        <div class="bg-white w-96 p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
            <h2 class="mb-6 text-xl">Course Check Form</h2>

            <div class="py-3">
                <?php
                if ($_SESSION['user_type'] != "Student") {
                ?>
                    <div class="relative mb-6">
                        <input type="text" name="studno" id="studno" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="Student No">
                        <label for="studno" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Student No <span class="text-danger">*</span></label>
                    </div>
                <?php } ?>
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
                <button id="loadSubjects" class="w-full bg-brand hover:bg-brand-dark transition-all rounded-md px-4 py-3 text-stone-50">Load Subjects</button>
            </div>

        </div>


    </div>
    <div class="flex-auto">
        <div id="itemContainer" class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
            No Subject(s) loaded
        </div>
        <?php
        if ($_SESSION['user_type'] != "Student") {
        ?>
            <div class="hidden bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
                <h2 class="text-xl">To Enroll Subject(s)</h2>
                <div id="enrolledSubjects">

                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?>