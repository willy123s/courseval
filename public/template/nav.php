<?php

use function Makkari\Helpers\Breadcrumb;
if ($_SESSION['user_type'] == "Students") {
?>

<aside class="relative flex flex-col shrink-0 justify-between w-full max-w-fit sm:w-fit lg:w-[340px] bg-sky-200 border-r border-slate-700/20 shadow-xl shadow-black/5" style="position: relative; overflow: hidden;">
    <!-- Your content here -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 255, 0.1);"></div>    <div class="px-4">
        <div class="py-4 flex flex-col lg:flex-row gap-4 items-center mb-6">

            <img src="/public/img/psulogo.png" class="w-8" alt="">

            <div class="hidden lg:block">
            <span class="background-text">Course Evaluation System</span>

            </div>
        </div>
        <div class="flex flex-col gap-1 text-brand-dark">
            <a href="/" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "" ? "bg-brand/5" : "" ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                </svg>
                <span class="hidden lg:block">Dashboard</span>
                <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                    <span class="">Dashboard</span>
                </div>
            </a>
            <?php
            if ($_SESSION['user_type'] != "Student") {
            ?>
                <a href="/studentgrades" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "studentgrades" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    </svg>
                    <span class="hidden lg:block">Curriculumn Evaluation</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Curriculumn Evaluation</span>
                    </div>
                </a>
            <?php
            }
            if ($_SESSION['user_type'] == "Student") :
            ?>
                <a href="/myCurriculums" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "mycurriculums" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    </svg>
                    <span class="hidden lg:block">Curriculumn Evaluation</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Curriculumn Evaluation</span>
                    </div>
                </a>
                <a href="/coursecheck" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "coursecheck" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        
                    </svg>
                    <span class="hidden lg:block">Course Evaluation </span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Course Evaluation</span>
                    </div>
                </a>
    <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
    </svg>

                        
                    </div>
                </a>
                </a>
                <a href="/proofs" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "proof" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    <span class="hidden lg:block">Proof of Grades</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Proof of Grades</span>
                    </div>
                </a>
            <?php
            endif;
            if ($_SESSION['user_type'] != "Student") :

            ?>
<!-- <p class="hidden lg:block text-sm my-2 text-slate-500 font-semibold px-2 font-bold" style="font-weight: 700;">File Management</p> -->
                <?php
                if ($_SESSION['user_type'] == "Admin") {


                ?>
                  <a href="/recovery" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "recovery" ? "bg-brand/5" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"></svg>
                        <span class="hidden lg:block">Recovery</span>
                        <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0 w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                            <span class="">Recovery</span>
                    <!-- <a href="/courses" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "courses" ? "bg-brand/5" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        </svg>
                        <span class="hidden lg:block">Course</span>
                        <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                            <span class="">Course</span>
                        </div>
                    </a>
                    <a href="/subjects" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "subjects" ? "bg-brand/5" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        </svg>
                        <span class="hidden lg:block">Subjects</span>
                        <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                            <span class="">Subjects</span>
                        </div>
                    </a>
                    <a href="/curriculums" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "curriculums" ? "bg-brand/5" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        </svg>
                        <span class="hidden lg:block">Curriculumns</span>
                        <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                            <span class="">Curriculumns</span>
                        </div>
                    </a>
                    <a href="/users" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "users" ? "bg-brand/5" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        </svg>
                        <span class="hidden lg:block">Users</span>
                        <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                            <span class="">Users</span>
                        </div>
                    </a>
                <?php
                }
                ?>
                <a href="/students" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "students" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    </svg>
                    <span class="hidden lg:block">Students</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Students</span>
                    </div>
                </a>
                <p class="hidden lg:block text-sm my-2 text-slate-500 font-semibold px-2 font-bold" style="font-weight: 800;">Transaction</p>
                <a href="/coursecheck" class="hidden relative group  flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "coursecheck" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    </svg>
                    <span class="hidden lg:block">Course Evaluation</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Course Evaluation   </span>
                    </div>
                </a>
                <a href="/preenroll" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "coursecheck" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    </svg>
                    <span class="hidden lg:block">Course Evaluation</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Course Evaluation</span>
                    </div>
                </a>

                <p class="hidden lg:block text-sm my-2 text-slate-500 font-semibold px-2 font-bold" style="font-weight: 700;">System Settings</p>
                <a href="/schoolyears" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "schoolyears" ? "bg-brand/5" : "" ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
</svg>
</svg>

                    <span class="hidden lg:block">School Year</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">School Year</span>
                    </div>
                </a>
                <a href="/semesters" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "semesters" ? "bg-brand/5" : "" ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    </svg>
                    <span class="hidden lg:block">Semesters</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Semesters</span>
                    </div>
                </a> -->


            <?php

            endif;

            ?>
        </div>
    </div>
    <div class="flex items-center justify-center mb-4">
    <p class="text-lg font-semibold text-indigo-800 bg-indigo-200 rounded-full px-8 py-4 shadow-lg">Pangasinan State University</p>
</div>


</aside>
<?php 
}
?>
<div class="relative h-screen overflow-y-auto flex-auto flex gap-6 flex-col">
    <!-- topbard -->
    <div class="sticky top-0 px-8 py-2 flex flex-row justify-between items-center bg-white shadow-lg shadow-black/5">
<a href="/" class="button">Menu</a>
<style>
    .button {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  color: white;
  background-color: #007BFF;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  text-align: center;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.button:hover {
  background-color: #0056b3;
}

</style>
    <div class="flex flex-row items-center gap-4">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                </svg>
            </a>
        </div>
        <div class="flex flex-row gap-4 p-2 items-center" style="font-weight: bold;">
    <!-- Dito ang nilalaman ng iyong div -->


        
            <div class="relative group">
                <a href="#" class="p-2">
                    <?= $userdata->getFname() ?>
                </a>
                <div class="hidden group-hover:block absolute right-0 w-52 min-w-fit rounded-xl bg-white border border-slate-700/10 shadow-lg shadow-black/5 ">


                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- topbard -->

    <div 