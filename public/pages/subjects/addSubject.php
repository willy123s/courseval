<div class="flex flex-row justify-between items-center mb-6">
    <p class="font-semibold text-lg text-slate-500">New Subject</p>
    <button class="close text-slate-400 hover:text-slate-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

<div class="">
    <form action="/subjects/save" method="post">
        <input type="hidden" name="csrf_token" id="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <div class="relative mb-6">
            <input type="text" name="code" id="code" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="code" />
            <label for="code" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Course <span class="text-danger">*</span></label>
        </div>
        <div class="relative mb-6">
            <input type="text" name="description" id="description" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="Description" />
            <label for="description" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Description <span class="text-danger">*</span></label>
        </div>
        <div class="relative mb-6">
            <input type="text" name="units" id="units" class="px-4 py-3 peer w-full border focus:outline-none focus:ring-2 focus:border-brand focus:ring-brand/20 rounded-md border-slate-700/10 placeholder:text-transparent" placeholder="Units" />
            <label for="units" class="absolute left-0 ml-2 px-1 -translate-y-3 bg-white text-sm duration-100 ease-linear peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-500 peer-focus:ml-2 peer-focus:-translate-y-3 peer-focus:px-1 peer-focus:text-sm">Units <span class="text-danger">*</span></label>
        </div>

        <button class="w-full bg-brand rounded-md px-4 py-3 text-stone-50">Save</button>
    </form>
</div>