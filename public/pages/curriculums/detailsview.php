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
    <div class="mb-4">
        <a href="http://localhost:8000/curriculums" class="px-3 py-2 text-sm bg-brand hover:bg-brand-dark rounded-md text-slate-100 transition-all">Back</a>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
        <h2 class="text-xl font-bold"><?= htmlspecialchars($curriculum->getName()) ?></h2>
        <p><?= htmlspecialchars($curriculum->getCourse() ? $curriculum->getCourse()->getDescription() : 'No Course Description') ?></p>
        <p><?= htmlspecialchars($curriculum->getSyDet() ? $curriculum->getSyDet()->getSchoolyear() : 'No School Year') ?></p>
    </div>

    <?php
    foreach ($yearlevels as $year) :
        $y = $year['yearlevels'];
        $s = $year['subjects'];
    ?>
        <div class="bg-white p-6 rounded-xl shadow-lg shadow-black/5 border border-slate-700/10 mb-6">
            <h2 class="text-lg text-slate-700 mb-6"><?= htmlspecialchars($y->getYear()) ?></h2>
            <div class="mb-4">
                <a href="#" data-remote="/curriculums/addsubject/<?= htmlspecialchars("{$curriculum->getId()}/{$y->getId()}") ?>" data-size="w-full md:w-2/5" class="pop px-3 py-2 text-sm bg-brand hover:bg-brand-dark rounded-md text-slate-100 transition-all">Add Subject</a>
            </div>

            <table class="w-full border border-slate-700/10 mb-2">
                <thead>
                    <tr class="bg-accent/20 text-left">
                        <th class="px-2 py-3">Code #</th>
                        <th class="px-2 py-3">Description</th>
                        <th class="px-2 py-3">Units</th>
                        <th class="px-2 py-3">Semester</th>
                        <th class="px-2 py-3">Co/Pre requisite</th>
                        <th class="px-2 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/10" id="tableBody">
                    <?php
                    if (sizeof($s) == 0) :
                        echo "<tr>";
                        echo "<td colspan='6' class='px-2 py-3 text-red'>No Record(s) Found</td>";
                        echo "</tr>";
                    endif;
                    foreach ($s as $subject) :
                        $prereq = $subject->getPreReqs();
                        $prereqs = [];
                        foreach ($prereq as $pp) {
                            $prereqs[] = $pp->getCode();
                        }
                    ?>
                        <tr class="transition-all">
                            <td class="px-2 py-3"><?= htmlspecialchars($subject->getSubject() ? $subject->getSubject()->getSubjectCode() : 'No Subject Code') ?></td>
                            <td class="px-2 py-3"><?= htmlspecialchars($subject->getSubject() ? $subject->getSubject()->getDescription() : 'No Description') ?></td>
                            <td class="px-2 py-3"><?= htmlspecialchars($subject->getSubject() ? $subject->getSubject()->getUnits() : 'No Units') ?></td>
                            <td class="px-2 py-3"><?= htmlspecialchars($subject->getSem() ? $subject->getSem()->getSem() : 'No Semester') ?></td>
                            <td class="px-2 py-3">
                                <div class="prereq focus:outline-brand/60 border border-slate-700/10" data-curr="<?= htmlspecialchars($curriculum->getId()) ?>" data-id="<?= htmlspecialchars($subject->getId()) ?>">&nbsp;
                                    <?php
                                    echo htmlspecialchars(implode(", ", $prereqs));
                                    ?>
                                </div>
                            </td>
                            <td class="px-2 py-3 flex flex-row item-center gap-2">
                                <a href="#" data-remote="/currdetails/confirm/<?= htmlspecialchars($subject->getId()) ?>" data-size="w-full md:w-2/5 lg:w-1/5" class="pop bg-danger-light hover:bg-danger transition-all text-slate-50 p-1 rounded-md text-sm" title="Remove">Delete</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    <?php
    endforeach;
    ?>
</div>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?>
</body>
</html>
