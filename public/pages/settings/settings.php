<?php
require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
?>
<div class="px-8">
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 divide-y divide-slate-700/10">
        <div class="bg-slate-50 px-4 py-2">
            <h3 class="font-semibold py-2 rounded-md">Full Name</h3>
            <p class="text-sm"><?= $userdata->getFullName() ?></p>
        </div>
        <div class="bg-slate-50 px-4 py-2">
            <h3 class="font-semibold py-2 rounded-md">Security</h3>
            <a href="#" data-remote="/settings/changepassword" data-size="w-full md:w-2/5 lg:w-1/5" class="pop text-sm text-blue-700 hover:underline">Change Password</a>
        </div>
    </div>
</div>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?>