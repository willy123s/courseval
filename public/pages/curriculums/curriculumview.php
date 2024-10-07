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
            border: 1px solid black; /* Thicker border */
            border-collapse: separate; /* Separate border model to avoid double borders */
            border-spacing: 0; /* No spacing between cells */
        }

        th,
        td {
            border: 1px solid black; /* Thicker border for table headers and cells */
            padding: 8px;
        }

        th {
            text-align: center; /* Center text in table headers */
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

        .btn-success {
            background-color: #16a34a;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #15803d;
        }

        .btn-danger {
            background-color: #dc2626;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }
    </style>
</head>
<body>
<div class="px-8">
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 thick-black-border">
        <div class="mb-4">
            <a href="#" data-remote="/curriculums/create" data-size="w-full md:w-2/5 lg:w-1/5" class="pop px-3 py-2 text-sm bg-brand hover:bg-brand-dark rounded-md text-slate-100 transition-all">Create Curriculum</a>
        </div>
        <div class="flex flex-row items-center justify-between mb-4">
            <div class="w-full md:w-2/5">
                <input type="search" class="px-3 py-2 w-full rounded-md border border-slate-700/20 focus:outline-none focus:ring ring-brand-light ring-offset-2" name="searchInput" id="searchInput" placeholder="Search">
            </div>
        </div>
        <div class="">
            <table class="w-full thick-black-border mb-2" id="dataTable">
                <thead>
                    <tr class="bg-accent/20 text-left">
                        <th class="px-2 py-3 thick-black-border">Name</th>
                        <th class="px-2 py-3 thick-black-border">Course</th>
                        <th class="px-2 py-3 thick-black-border">School Year</th>
                        <th class="px-2 py-3 min-w-fit max-w-fit thick-black-border">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/10" id="tableBody">
                    <?php
                    if (sizeof($curriculums) == 0) :
                        echo "<tr>";
                        echo "<td colspan='4' class='px-2 py-3 text-red thick-black-border'>No Record(s) Found</td>";
                        echo "</tr>";
                    endif;
                    foreach ($curriculums as $curriculum) :
                        $course = $curriculum->getCourse();
                        $schoolYear = $curriculum->getSyDet();
                    ?>
                        <tr class="transition-all">
                            <td class="px-2 py-3 thick-black-border"><?= htmlspecialchars($curriculum->getName()) ?></td>
                            <td class="px-2 py-3 thick-black-border"><?= $course ? htmlspecialchars($course->getCourse()) : 'N/A' ?></td>
                            <td class="px-2 py-3 thick-black-border"><?= $schoolYear ? htmlspecialchars($schoolYear->getSchoolyear()) : 'N/A' ?></td>
                            <td class="px-2 py-3 flex flex-row item-center gap-2 thick-black-border">
                                <a href="/curriculums/details/<?= htmlspecialchars($curriculum->getId()) ?>" class="text-sm bg-success-dark hover:bg-success-light transition-all text-slate-200 p-1 rounded-md" title="View Details">View</a>
                                <a href="#" data-remote="/curriculums/edit/<?= htmlspecialchars($curriculum->getId()) ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop text-sm bg-brand-dark hover:bg-brand-light transition-all text-slate-200 p-1 rounded-md" title="Edit">Edit</a>
                                <a href="#" data-remote="/curriculums/confirm/<?= htmlspecialchars($curriculum->getId()) ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop text-sm bg-danger-light hover:bg-danger transition-all text-slate-50 p-1 rounded-md" title="Delete">Delete</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <div class="flex flex-row justify-between">
                <div class="">
                    <p>(<?= sizeof($curriculums) ?>) Record(s)</p>
                </div>
                <div class="flex flex-row gap-2 items-center rounded-md border border-slate-700/5 overflow-hidden">
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
