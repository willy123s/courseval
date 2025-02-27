<?php
require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
?>
<div class="px-8">
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10">
        <div class="mb-4">
            <a href="#" data-remote="/proofs/create" data-size="w-full md:w-2/5 lg:w-1/5" class="pop px-3 py-2 text-sm bg-brand hover:bg-brand-dark rounded-md text-slate-100 transition-all">Add Proof</a>
        </div>
        <div class="flex flex-row items-center justify-between mb-4">
            <div class="w-full md:w-2/5">
                <input type="search" class="px-3 py-2 w-full rounded-md border border-slate-700/20 focus:outline-none focus:ring ring-brand-light ring-offset-2" name="searchInput" id="searchInput" placeholder="Search">
            </div>
        </div>
        <div class="">
            <table class="w-full border border-slate-700/10 mb-2" id="dataTable">
                <thead>
                    <tr class="bg-blue-800 text-left">
                        <th class="px-2 py-3">File</th>
                        <th class="px-2 py-3">School Year</th>
                        <th class="px-2 py-3">Semester</th>
                        <th class="px-2 py-3">Action</th>
                    </tr>   
                </thead>
                <tbody class="divide-y divide-slate-700/10" id="tableBody">
                    <?php if (sizeof($proofs) == 0) : ?>
                        <tr>
                            <td colspan="4" class="px-2 py-3 text-red">No Record(s) Found</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($proofs as $p) : ?>
                            <tr class="transition-all">
                                <td class="px-2 py-3">
                                    <a href="#" data-remote="/proofs/v/<?= $p->getId() ?>" data-size="w-full" class="pop hover:text-blue-500 hover:underline">Proof of Grade</a>
                                </td>
                                <td class="px-2 py-3"><?= htmlspecialchars($p->getSY()) ?></td>
                                <td class="px-2 py-3"><?= htmlspecialchars($p->getSem()) ?></td>
                                <td class="px-2 py-3 flex flex-row items-center gap-2">
                                    <a href="#" data-remote="/proofs/confirm/<?= $p->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-danger-light hover:bg-danger transition-all text-slate-50 p-1 rounded-md">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="flex flex-row justify-between">
                <div class="">
                    <p>(<?= sizeof($proofs) ?>) Record(s)</p>
                </div>
                <div class="flex flex-row gap-2 items-center rounded-md border border-slate-700/10 overflow-hidden">
                    <button onclick="prevPage()" class="px-3 py-2 disabled:text-slate-400 disabled:hover:bg-transparent hover:bg-blue-700 hover:text-white transition-all" id="prevBtn" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <span id="currentPage"></span>
                        <button onclick="nextPage()" id="nextBtn" class="px-3 py-2 disabled:text-slate-400 disabled:hover:bg-transparent hover:bg-blue-700 hover:text-white transition-all" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?>
