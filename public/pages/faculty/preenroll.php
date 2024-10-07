<?php

require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .thick-black-border {
            border: 1px solid black;
            border-collapse: separate;
            border-spacing: 0;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            text-align: center;
            background-color: #f1f5f9;
            color: #1e293b;
        }

        tbody tr:hover {
            background-color: #e2e8f0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary {
            background-color: #2563eb;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #1e40af;
        }

        .search-input {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }
    </style>
</head>

<body>
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
<?php } else { ?>
    <div class="px-8">
        <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
            <h2 class="text-xl mb-4">Course Evaluation Student Lists</h2>
            <div class="flex flex-row items-center justify-between mb-4">
                <div class="w-full md:w-2/5">
                    <input type="search" class="px-3 py-2 w-full rounded-md border border-slate-700/20 focus:outline-none  focus:ring ring-brand-light ring-offset-2" name="searchInput" id="searchInput" placeholder="Search">
                </div>
            </div>
            <table class="w-full border border-slate-700/10 mb-2" id="dataTable">
                <thead>
                    <tr class="bg-accent/20 text-left ">
                        <th class="px-2 py-3">Stud #</th>
                        <th class="px-2 py-3">Fullname</th>
                        <th class="px-2 py-3">School Year</th>
                        <th class="px-2 py-3">Semester</th>
                        <th class="px-2 py-3">Status</th>
                        <th class="px-2 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/10 " id="tableBody">
                    <?php
                    foreach ($coursechecked as $enroll) {
                        $student = $enroll->getStudent();
                        $schoolyear = $enroll->getSchoolYear();
                        $sem = $enroll->getSem();
                    ?>
                        <tr>
                            <td class="px-2 py-3"><?= $student->getStudNo() ?></td>
                            <td class="px-2 py-3"><?= $student->getFullName() ?></td>
                            <td class="px-2 py-3"><?= $schoolyear->getSchoolYear() ?></td>
                            <td class="px-2 py-3"><?= $sem->getSem() ?></td>
                            <td class="px-2 py-3"><?= $enroll->getStatus() ?></td>
                            <td class="px-2 py-3 flex flex-row item-center gap-2">
                            <a href="/preenroll/transaction/<?= $enroll->getId() ?>/<?= $student->getStudNo() ?>" class="text-sm bg-brand-dark hover:bg-brand-light transition-all text-slate-200 p-1 rounded-md">
    View
</a>
                        
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>    
            </table>
            <div class="flex flex-row justify-between">
                <div class="">
                    <p>(<?= sizeof($coursechecked) ?>) Record(s)</p>
                </div>
                <div class="flex flex-row gap-2 items-center rounded-md border border-slate-700/10 overflow-hidden">
                    <button class="px-3 py-2 disabled:text-slate-400 disabled:hover:bg-transparent hover:bg-blue-700 hover:text-white transition-all " id="prevBtn" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <span id="currentPage"></span>
                    <button id="nextBtn" class="px-3 py-2 disabled:text-slate-400 disabled:hover:bg-transparent hover:bg-blue-700 hover:text-white transition-all" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php
}
require_once(TEMPLATE_PATH . "/footer.php");
?>
</body>
</html>