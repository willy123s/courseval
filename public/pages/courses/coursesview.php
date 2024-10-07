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
            border: 2px solid #1e293b;
            border-collapse: separate;
            border-spacing: 0;
        }

        .thick-black-border th,
        .thick-black-border td {
            border: 1px solid #cbd5e1;
            padding: 12px;
        }

        .thick-black-border th {
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

        .btn-danger {
            background-color: #dc2626;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-disabled {
            background-color: #94a3b8;
            color: #f1f5f9;
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
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10">
        <div class="mb-4">
            <a href="#" data-remote="/courses/create" data-size="w-full md:w-2/5 lg:w-1/5" class="pop px-3 py-2 text-sm bg-brand hover:bg-brand-dark rounded-md text-slate-100 transition-all">Add Courses</a>
        </div>
        <div class="flex flex-row items-center justify-between mb-4">
            <div class="w-full md:w-2/5">
                <input type="search" class="px-3 py-2 w-full rounded-md border border-slate-700/20 focus:outline-none focus:ring ring-brand-light ring-offset-2" name="searchInput" id="searchInput" placeholder="Search">
            </div>
        </div>
        <div class="">
            <table class="w-full thick-black-border mb-2 text-base" id="dataTable">
                <thead>
                    <tr class="bg-accent/20 text-left">
                        <th class="px-4 py-3">Course</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php

                    if (sizeof($courses) == 0) :
                        echo "<tr>";
                        echo "<td colspan='3' class='px-4 py-3 text-red thick-black-border'>No Record(s) Found</td>";
                        echo "</tr>";
                    endif;
                    foreach ($courses as $course) :

                    ?>
                        <tr class="transition-all thick-black-border">
                            <td class="px-4 py-3"><?= $course->getCourse() ?></td>
                            <td class="px-4 py-3"><?= $course->getDescription() ?></td>
                            <td class="px-4 py-3 flex flex-row items-center gap-2">
                                <a href="#" data-remote="/courses/edit/<?= $course->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop text-sm bg-brand-dark hover:bg-brand-light transition-all text-slate-200 p-1 rounded-md">Edit</a>
                                <a href="#" data-remote="/courses/confirm/<?= $course->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop text-sm bg-danger-light hover:bg-danger transition-all text-slate-50 p-1 rounded-md">Delete</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <div class="flex flex-row justify-between">
                <div class="">
                    <p>(<?= sizeof($courses) ?>) Record(s)</p>
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
    
</body>
</html>
