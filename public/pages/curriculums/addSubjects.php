<div class="flex flex-row justify-between items-center mb-6">
    <p class="font-semibold text-lg text-slate-500">Load Subjects</p>
    <button class="close text-slate-400 hover:text-slate-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<div class="">
    <form action="/curriculums/savesubject" method="post">
        <input type="hidden" name="csrf_token" id="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <input type="hidden" name="currId" id="currId" value="<?= $curr ?>">
        <input type="hidden" name="yrlvl" id="yrlvl" value="<?= $yrlvl ?>">

        <div class="relative mb-6">
            <select name="semester" id="semester" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent">
                <?php
                foreach ($semesters as $sem) :
                ?>
                    <option value="<?= $sem->getId() ?>"><?= $sem->getSem() ?></option>
                <?php
                endforeach;
                ?>
            </select>
            <label for="semester" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Semester <span class="text-danger">*</span></label>
        </div>

        <div class="relative rounded-lg shadow-sm w-full mb-6">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-auto">
                <svg class="absolute text-slate-400 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="filterSubject" data-target="subjects" data-curr="" placeholder="Search" class="font-sans block text-sm w-full pl-10 py-2 px-3 ring-1 ring-brand/10 focus:outline-brand text-slate-500 rounded-lg dark:bg-slate-800 dark:ring-0 dark:highlight-white/5 dark:text-slate-400">
        </div>

        <div id="resultContainer" class="min-h-[350px] max-h-[80%]">
            <?php
            foreach ($subjects as $subject) :
            ?>
                <div class="px-3 py-2 mb-2 border border-slate-700/10 rounded-md">
                    <input type="checkbox" class="focus:ring-2 focus:ring-offset-1 accent-accent focus:ring-accent-dark rounded-md p-2" name="subject[]" id="subject<?= $subject->getId() ?>" value="<?= $subject->getId() ?>">
                    <label for="subject<?= $subject->getId() ?>">
                        <span><?= $subject->getSubjectCode() ?></span>
                        <span><?= $subject->getDescription() ?></span>
                    </label>
                </div>
            <?php
            endforeach
            ?>
        </div>

        <button class="w-full bg-brand rounded-md px-4 py-3 text-stone-50">Add Subjects</button>
    </form>
</div>