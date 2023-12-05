<?php

use Makkari\Controllers\Grades;

require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
?>
<div class="px-8">
    <a href="#" data-remote="/preenroll/create" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-brand hover:bg-brand-dark transition-all rounded-md px-4 py-1 text-stone-50 text-sm">New</a>
    <?php
    if (isset($_SESSION['coursecheck'])) :
    ?>
        <div class="mb-6">
            <?= $studentdata->getFullName() ?>
        </div>
    <?php
    endif;
    ?>
</div>
<?php
if (isset($_SESSION['coursecheck'])) {
?>
    <div class="px-8 flex flex-row gap-6">
        <div>
            <div class="bg-white w-96 p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
                <h2></h2>
            </div>
        </div>
        <div class="flex-auto">
            <div id="itemContainer" class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">

            </div>
        </div>
    </div>
<?php } ?>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?>