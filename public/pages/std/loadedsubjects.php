<div>
    <table class="w-full border border-slate-700/10">
        <thead>
            <tr class="bg-light-blue-dark text-left">
                <th class="px-2 py-1">Code</th>
                <th class="px-2 py-1">Description</th>
                <th class="px-2 py-1">Unit</th>
                <th class="px-2 py-1">Pre-Req</th>
            </tr>
        </thead>
        <tbody id="checkboxList">
            <?php
            foreach ($loads as $load) {
                $subject = $load->getSubject();

                $prereq = $load->getPreReqs();
                $prereqs = [];
                foreach ($prereq as $pp) {
                    $prereqs[] = $pp->getCode();
                }
            ?>
                <tr class="even:bg-light-blue">
                    <td class="px-2 py-1"><?= $subject->getSubjectCode() ?></td>
                    <td class="px-2 py-1"><?= $subject->getDescription() ?></td>
                    <td class="px-2 py-1"><?= $subject->getUnits() ?></td>
                    <td class="px-2 py-1"><?= implode(", ", $prereqs); ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php if ($_SESSION['user_type'] != "Student") : ?>
        <button onclick="getCheckedCheckboxes()" class="px-3 py-2 text-sm bg-light-blue hover:bg-light-blue-dark text-white mt-6 rounded-lg">Add to Enrollment</button>
    <?php endif; ?>
    <div></div>
</div>
