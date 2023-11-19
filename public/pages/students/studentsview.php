<?php
require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
?>
<div class="px-8">
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10">
        <div class="mb-4">
            <a href="#" data-remote="/students/create" data-size="w-full md:w-2/5 lg:w-1/5" class="pop px-3 py-2 text-sm bg-brand hover:bg-brand-dark rounded-md text-slate-100 transition-all">Add Studens</a>
            <a href="#" data-remote="/students/import" data-size="w-full md:w-2/5 lg:w-1/5" class="pop hidden px-3 py-2 text-sm bg-brand hover:bg-brand-dark rounded-md text-slate-100 transition-all">Import From CSV</a>
        </div>
        <div class="flex flex-row items-center justify-between mb-4">
            <div class="w-full md:w-2/5">
                <input type="search" class="px-3 py-2 w-full rounded-md border border-slate-700/20 focus:outline-none  focus:ring ring-brand-light ring-offset-2" name="searchInput" id="searchInput" placeholder="Search">
            </div>
        </div>
        <div class="">
            <table class="w-full border border-slate-700/10 mb-2" id="dataTable">
                <thead>
                    <tr class="bg-accent/20 text-left ">
                        <th class="px-2 py-3">Stud #</th>
                        <th class="px-2 py-3">Name</th>
                        <th class="px-2 py-3">Course</th>
                        <th class="px-2 py-3">Year Lvl</th>
                        <th class=" px-2 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/10 " id="tableBody">
                    <?php

                    if (sizeof($students) == 0) :
                        echo "<tr>";
                        echo "<td colspan='5' class='px-2 py-3 text-red'>No Record(s) Found</td>";
                        echo "</tr>";
                    endif;
                    foreach ($students as $student) :

                    ?>
                        <tr class="transition-all">
                            <td class="px-2 py-3"><?= $student->getStudNo() ?></td>
                            <td class="px-2 py-3"><?= $student->getFullName() ?></td>
                            <td class="px-2 py-3"><?= $student->getCourse()->getCourse() ?></td>
                            <td class="px-2 py-3"><?= $student->getCurriculum()->getName() ?></td>
                            <td class="px-2 py-3 flex flex-row item-center gap-2">
                                <a href="#" data-remote="/students/edit/<?= $student->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-brand-dark hover:bg-brand-light transition-all text-slate-200 px-2 py-1 rounded-md">Edit</a>
                                <a href="#" data-remote="/students/confirm/<?= $student->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-danger-light hover:bg-danger transition-all text-slate-50 px-2 py-1 rounded-md">Delete</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <div class="flex flex-row justify-between">
                <div class="">
                    <p>(<?= sizeof($students) ?>) Record(s)</p>
                </div>
                <div class="flex flex-row gap-2 items-center rounded-md border border-slate-700/10 overflow-hidden">
                    <button onclick="prevPage()" class="px-3 py-2 disabled:text-slate-400 disabled:hover:bg-transparent hover:bg-blue-700 hover:text-white transition-all " id="prevBtn" disabled>
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