<?php
require_once(TEMPLATE_PATH . "/header.php");
require_once(TEMPLATE_PATH . "/nav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Management</title>
    <style>
        /* General Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Table Styles */
        .thick-black-border {
            border: 2px solid #1e293b;
            border-collapse: separate;
            border-spacing: 0;
        }

        th, td {
            border: 1px solid #cbd5e1;
            padding: 10px;
        }

        th {
            text-align: center;
            background-color: #f1f5f9;
            color: #1e293b;
        }

        tbody tr:hover {
            background-color: #e2e8f0;
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 5px;
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

        /* Search Input */
        .search-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }

        /* Responsive Adjustments */
        @media (min-width: 768px) {
            .container {
                padding: 40px;
            }

            .btn {
                font-size: 14px;
                padding: 10px 16px;
            }

            th, td {
                padding: 12px;
            }

            .search-input {
                padding: 12px 16px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10">
        <div class="mb-4">
            <a href="#" data-remote="/subjects/create" data-size="w-full md:w-2/5 lg:w-1/5" class="pop px-3 py-2 text-sm bg-brand hover:bg-brand-dark rounded-md text-slate-100 transition-all">Add Subject</a>
        </div>
        <div class="flex flex-row items-center justify-between mb-4">
            <div class="w-full md:w-2/5">
                <input type="search" class="search-input" name="searchInput" id="searchInput" placeholder="Search">
            </div>
        </div>
        <div class="">
            <table class="w-full border border-slate-700/10 mb-2" id="dataTable">
                <thead>
                    <tr class="bg-accent/20 text-left">
                        <th class="px-2 py-3">Code #</th>
                        <th class="px-2 py-3">Description</th>
                        <th class="px-2 py-3">Units</th>
                        <th class="px-2 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/10" id="tableBody">
                    <?php
                    if (sizeof($subjects) == 0) :
                        echo "<tr>";
                        echo "<td colspan='4' class='px-2 py-3 text-red'>No Record(s) Found</td>";
                        echo "</tr>";
                    endif;
                    foreach ($subjects as $subject) :
                    ?>
                        <tr class="transition-all">
                            <td class="px-2 py-3"><?= $subject->getSubjectCode() ?></td>
                            <td class="px-2 py-3"><?= $subject->getDescription() ?></td>
                            <td class="px-2 py-3"><?= $subject->getUnits() ?></td>
                            <td class="px-2 py-3 flex flex-row items-center gap-2">
                                <a href="#" data-remote="/subjects/edit/<?= $subject->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="btn btn-primary">
                                    Edit
                                </a>
                                <!-- Delete Button -->
                                <a href="#" data-remote="/subjects/confirm/<?= $subject->getId() ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="btn btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <div class="flex flex-row justify-between">
                <div>
                    <p>(<?= sizeof($subjects) ?>) Record(s)</p>
                </div>
                <div class="flex flex-row gap-2 items-center rounded-md border border-slate-700/10 overflow-hidden">
                    <button class="btn btn-disabled" id="prevBtn" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <span id="currentPage">1</span>
                    <button id="nextBtn" class="btn btn-disabled" disabled>
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
