<?php

use Makkari\Controllers\Grades;

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
        /* Base Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-container, .checkbox-container {
            background-color: white;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-container h2, .checkbox-container h2 {
            margin: 0 0 1rem;
            font-size: 1.5rem;
            color: #333;
        }

        .relative {
            position: relative;
        }

        .input-field, .select-field {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            background-color: #fff;
            font-size: 1rem;
            color: #333;
        }

        .input-field:focus, .select-field:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
            outline: none;
        }

        .label {
            position: absolute;
            top: -0.75rem;
            left: 0.75rem;
            font-size: 0.875rem;
            color: #555;
            background-color: white;
            padding: 0 0.25rem;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 0.375rem;
            color: #fff;
            background-color: ;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #1e40af;
        }

        .hidden {
            display: none;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="form-container">
        <h2>Course Evaluation Form</h2>
        <div>
            <?php
            if ($_SESSION['user_type'] != "Student") {
            ?>
                <div class="relative">
                    <input type="text" name="studno" id="studno" class="input-field" placeholder="Student No">
                    <label for="studno" class="label">Student No <span class="text-danger">*</span></label>
                </div>
            <?php } ?>
            <div class="relative">
                <select name="year" id="year" class="select-field">
                    <?php
                    foreach ($yearlevels as $yearlevel) {
                        echo "<option value='{$yearlevel->getId()}'>{$yearlevel->getYear()}</option>";
                    }
                    ?>
                </select>
                <label for="year" class="label">Year Level <span class="text-danger">*</span></label>
            </div>
            <div class="relative">
                <select name="sem" id="sem" class="select-field">
                    <?php
                    foreach ($semesters as $semester) {
                        echo "<option value='{$semester->getId()}'>{$semester->getSem()}</option>";
                    }
                    ?>
                </select>
                <label for="sem" class="label">Semester <span class="text-danger">*</span></label>
            </div>
            <button id="loadSubjects" class="button">Load Subjects</button>
        </div>
    </div>

    <div class="checkbox-container">
        <div id="itemContainer">
            No Subject(s) loaded
        </div>
        <?php
        if ($_SESSION['user_type'] != "Student") {
        ?>
            <div class="hidden">
                <h2>To Enroll Subject(s)</h2>
                <div id="enrolledSubjects">
                    <!-- Enrolled subjects content -->
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
require_once(TEMPLATE_PATH . "/footer.php");
?>
