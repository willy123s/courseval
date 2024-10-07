<div>
    <form action="/preenroll/addsubjects/<?= $enid ?>" method="post">
        <table class="w-full">
            <thead>
                <tr class="bg-light-blue-500/30">
                    <th class="px-2 py-1 text-left">
                        <input type="checkbox" id="selectAll"> Check
                    </th>
                    <th class="px-2 py-1 text-left">Code</th>
                    <th class="px-2 py-1 text-left">Description</th>
                    <th class="px-2 py-1 text-left">Unit</th>
                    <th class="px-2 py-1 text-left">Pre-Req</th>
                    <th class="px-2 py-1 text-left">Grade</th>
                </tr>
            </thead>    
            <tbody id="checkboxList">
                <?php
                foreach ($loads as $load) {
                    $subject = $load->getSubject();
                    $grade = $load->getGradesByStudent($student->getId());
                    $grades = array();
                    foreach ($grade as $g) {
                        $grades[] = $g->getGrade();
                    }

                    $prereq = $load->getPreReqs();
                    $prereqs = [];
                    foreach ($prereq as $pp) {
                        $prereqs[] = $pp->getCode();
                    }
                ?>
                    <tr class="even:bg-slate-50">
                        <td class="px-2 py-1">
                            <input type="checkbox" name="subjects[]" value="<?= $load->getId() ?>" class="subject-checkbox">
                        </td>
                        <td class="px-2 py-1"><?= $subject->getSubjectCode() ?></td>
                        <td class="px-2 py-1"><?= $subject->getDescription() ?></td>
                        <td class="px-2 py-1"><?= $subject->getUnits() ?></td>
                        <td class="px-2 py-1"> <?= implode(", ", $prereqs); ?></td>
                        <td class="px-2 py-1"> <?= implode(" / ", $grades) ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php if ($_SESSION['user_type'] != "Student") : ?>
            <button class="px-3 py-2 text-sm bg-brand hover:bg-brand-dark text-white mt-6 rounded-lg">Add to Enrollment</button>
        <?php endif; ?>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.subject-checkbox');

        // Function to select or deselect all checkboxes
        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    });
</script>
