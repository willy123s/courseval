<div>
    <table class="w-full">
        <thead>
            <tr class="bg-accent/30">
                <th class="px-2 py-1 text-left">Check</th>
                <th class="px-2 py-1 text-left">Code</th>
                <th class="px-2 py-1 text-left">Description</th>
                <th class="px-2 py-1 text-left">Unit</th>
                <th class="px-2 py-1 text-left">Pre-Req</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($loads as $load) {
                $subject = $load->getSubject();

                $prereq = $load->getPreReqs();
                $prereqs = [];
                foreach ($prereq as $pp) {
                    $prereqs[] = $pp->getCode();
                }
            ?>
                <tr class="even:bg-slate-50">
                    <td class="px-2 py-1">
                        <input type="checkbox" name="" id="">
                    </td>
                    <td class="px-2 py-1"><?= $subject->getSubjectCode() ?></td>
                    <td class="px-2 py-1"><?= $subject->getDescription() ?></td>
                    <td class="px-2 py-1"><?= $subject->getUnits() ?></td>
                    <td class="px-2 py-1"> <?= implode(", ", $prereqs); ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div>

    </div>
</div>