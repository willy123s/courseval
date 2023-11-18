<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;
use Makkari\Models\Service;
use Makkari\Models\Subject;

class API extends Controller
{
    // private $model;

    public static function read($model, $id)
    {
        // if ($model == "service") {
        //     $services = Service::findByOfficeId($id);
        //     $options = "";
        //     foreach ($services as $service) {
        //         $options .= "<option value='" . $service->getService_id() . "'>" . $service->getServices() . "</option>";
        //     }
        //     echo $options;
        // }
    }

    public static function fetch()
    {
        if ($_POST['target'] == "subjects") {
            $subjects = Subject::getByKeyButNotIn($_POST['curr'], self::clean($_POST['key']));
            foreach ($subjects as $subject) {
?>
                <div class="px-3 py-2 mb-2 border border-slate-700/10 rounded-md">
                    <input type="checkbox" class="focus:ring-2 focus:ring-offset-1 accent-accent focus:ring-accent-dark rounded-md p-2" name="subject[]" id="subject<?= $subject->getId() ?>" value="<?= $subject->getId() ?>">
                    <label for="subject<?= $subject->getId() ?>">
                        <span><?= $subject->getSubjectCode() ?></span>
                        <span><?= $subject->getDescription() ?></span>
                    </label>
                </div>
<?php
            }
        }
    }
}
