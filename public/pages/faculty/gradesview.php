<?php

use Makkari\Controllers\Grades;
    
require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
?>
<div class="px-8 flex flex-row gap-4">
    <div class="w-64  shrink-0">
        <div class="bg-white sticky top-20  p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
            <h2 class="mb-6 text-xl">Search By Student</h2>
            <div class="relative mb-6">
                <input type="text" name="studno" id="studno" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="Student No" value="<?= isset($user) ? $user->getStudNo() : "" ?>">
                <label for="studno" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Student No <span class="text-danger">*</span></label>
            </div>
            <button id="loadGrades" class="w-full bg-brand hover:bg-brand-dark transition-all rounded-md px-4 py-3 text-stone-50">Load Checklist/Grade</button>
        </div>
    </div>
    <div class="flex-auto" id="itemContainer">
        <?php
        if (isset($curriculum)) {
            require_once(PAGES_PATH . "/faculty/loadGrades.php");
        } else {
            echo "No data loaded";
        }
        ?>
    </div>
</div>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?>