<div class="flex flex-row justify-between items-center mb-6">
    <p class="font-semibold text-lg text-slate-500">Edit Student</p>
    <button class="close text-slate-400 hover:text-slate-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<div class="">
    <form action="/students/save" method="post">
        <input type="hidden" name="csrf_token" id="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <input type="hidden" name="id" id="id" value="<?= $student->getId() ?>">

        <div class=" relative mb-6">
            <input type="text" name="stnumber" id="stnumber" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="stnumber" value="<?= $student->getStudNo() ?>" />
            <label for="stnumber" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Student Number <span class="text-danger">*</span></label>
        </div>
        <div class=" relative mb-6">
            <input type="text" name="fname" id="fname" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="fname" value="<?= $student->getFname() ?>" />
            <label for="fname" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">First Name <span class="text-danger">*</span></label>
        </div>
        <div class=" relative mb-6">
            <input type="text" name="mname" id="mname" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="mname" value="<?= $student->getMname() ?>" />
            <label for="mname" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Middle Name </label>
        </div>
        <div class=" relative mb-6">
            <input type="text" name="lname" id="lname" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="lname" value="<?= $student->getLname() ?>" />
            <label for="lname" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Last Name <span class="text-danger">*</span></label>
        </div>
        <div class=" relative mb-6">
            <input type="email" name="email" id="email" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="email" value="<?= $student->getEmail() ?>" />
            <label for="lname" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Email <span class="text-danger">*</span></label>
        </div>
        <div class=" relative mb-6">
            <select name="course" id="course" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent">
                <?php
                foreach ($courses as $course) {
                ?>
                    <option value="<?= $course->getId() ?>" <?= $course->getId() == $student->getCourseId() ? "selected" : "" ?>><?= $course->getCourse() ?></option>
                <?php } ?>
            </select>
            <label for="lname" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Course <span class="text-danger">*</span></label>
        </div>
        <div class=" relative mb-6">
            <select name="curr" id="curr" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent">
                <?php
                foreach ($curriculums as $curriculum) {
                ?>
                    <option value="<?= $curriculum->getId() ?>" <?= $curriculum->getId() == $student->getCurrId() ? "selected" : "" ?>><?= $curriculum->getName() ?></option>
                <?php } ?>
            </select>
            <label for="lname" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Course <span class="text-danger">*</span></label>
        </div>



        <button class="w-full bg-brand rounded-md px-4 py-3 text-stone-50">Save</button>
    </form>
</div>