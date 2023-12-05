<div class="flex flex-row justify-between items-center mb-6">
    <p class="font-semibold text-lg text-slate-500">Add Grade</p>
    <button class="close text-slate-400 hover:text-slate-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<div class="">
    <form action="/grades/update" method="post">
        <input type="hidden" name="csrf_token" id="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <input type="hidden" name="id" id="id" value="<?= $grade->getId() ?>">

        <div class="relative mb-6">
            <input type="text" name="grade" id="grade" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="grade" value="<?= $grade->getGrade() ?>" />
            <label for="grade" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Grade <span class="text-danger">*</span></label>
        </div>

        <div class="relative mb-6">
            <select name="semester" id="semester" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent">
                <?php
                foreach ($semesters as $sem) :
                ?>
                    <option value="<?= $sem->getId() ?>" <?= $sem->getId() == $grade->getSemester() ? "selected" : "" ?>><?= $sem->getSem() ?></option>
                <?php
                endforeach;
                ?>
            </select>
            <label for="semester" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Semester <span class="text-danger">*</span></label>
        </div>
        <div class="relative mb-6">
            <select name="sy" id="sy" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent">
                <?php
                foreach ($schoolyear as $sy) :
                ?>
                    <option value="<?= $sy->getId() ?>" <?= $sy->getId() == $grade->getSchoolyear() ? "selected" : "" ?>><?= $sy->getSchoolyear() ?></option>
                <?php
                endforeach;
                ?>
            </select>
            <label for="sy" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">School Year <span class="text-danger">*</span></label>
        </div>



        <button class="w-full bg-brand rounded-md px-4 py-3 text-stone-50">Save</button>
    </form>
</div>