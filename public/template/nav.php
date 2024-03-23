<?php

use function Makkari\Helpers\Breadcrumb;
?>
<aside class="flex flex-col shrink-0 justify-between w-full max-w-fit sm:w-fit lg:w-[340px]  bg-white border-r border-slate-700/20 shadow-xl shadow-black/5">
    <div class="px-4">
        <div class="py-4 flex flex-col lg:flex-row gap-4 items-center mb-6">

            <img src="/public/img/psulogo.png" class="w-8" alt="">

            <div class="hidden lg:block">
                <span class="p-2 text-base font-black text-slate-700 bg-accent">PSUSC</span> Course Checking System
            </div>
        </div>
        <div class="flex flex-col gap-1 text-brand-dark">
            <a href="/" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "" ? "bg-brand/5" : "" ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path d="M2 4.25A2.25 2.25 0 014.25 2h2.5A2.25 2.25 0 019 4.25v2.5A2.25 2.25 0 016.75 9h-2.5A2.25 2.25 0 012 6.75v-2.5zM2 13.25A2.25 2.25 0 014.25 11h2.5A2.25 2.25 0 019 13.25v2.5A2.25 2.25 0 016.75 18h-2.5A2.25 2.25 0 012 15.75v-2.5zM11 4.25A2.25 2.25 0 0113.25 2h2.5A2.25 2.25 0 0118 4.25v2.5A2.25 2.25 0 0115.75 9h-2.5A2.25 2.25 0 0111 6.75v-2.5zM15.25 11.75a.75.75 0 00-1.5 0v2h-2a.75.75 0 000 1.5h2v2a.75.75 0 001.5 0v-2h2a.75.75 0 000-1.5h-2v-2z" />
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
                        <path fill-rule="evenodd" d="M9.638 1.093a.75.75 0 01.724 0l2 1.104a.75.75 0 11-.724 1.313L10 2.607l-1.638.903a.75.75 0 11-.724-1.313l2-1.104zM5.403 4.287a.75.75 0 01-.295 1.019l-.805.444.805.444a.75.75 0 01-.724 1.314L3.5 7.02v.73a.75.75 0 01-1.5 0v-2a.75.75 0 01.388-.657l1.996-1.1a.75.75 0 011.019.294zm9.194 0a.75.75 0 011.02-.295l1.995 1.101A.75.75 0 0118 5.75v2a.75.75 0 01-1.5 0v-.73l-.884.488a.75.75 0 11-.724-1.314l.806-.444-.806-.444a.75.75 0 01-.295-1.02zM7.343 8.284a.75.75 0 011.02-.294L10 8.893l1.638-.903a.75.75 0 11.724 1.313l-1.612.89v1.557a.75.75 0 01-1.5 0v-1.557l-1.612-.89a.75.75 0 01-.295-1.019zM2.75 11.5a.75.75 0 01.75.75v1.557l1.608.887a.75.75 0 01-.724 1.314l-1.996-1.101A.75.75 0 012 14.25v-2a.75.75 0 01.75-.75zm14.5 0a.75.75 0 01.75.75v2a.75.75 0 01-.388.657l-1.996 1.1a.75.75 0 11-.724-1.313l1.608-.887V12.25a.75.75 0 01.75-.75zm-7.25 4a.75.75 0 01.75.75v.73l.888-.49a.75.75 0 01.724 1.313l-2 1.104a.75.75 0 01-.724 0l-2-1.104a.75.75 0 11.724-1.313l.888.49v-.73a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                    </svg>
                    <span class="hidden lg:block">Curriculumn Checklist</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Curriculumn Checklist</span>
                    </div>
                </a>
            <?php
            }
            if ($_SESSION['user_type'] == "Student") :
            ?>
                <a href="/myCurriculums" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "mycurriculums" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M9.638 1.093a.75.75 0 01.724 0l2 1.104a.75.75 0 11-.724 1.313L10 2.607l-1.638.903a.75.75 0 11-.724-1.313l2-1.104zM5.403 4.287a.75.75 0 01-.295 1.019l-.805.444.805.444a.75.75 0 01-.724 1.314L3.5 7.02v.73a.75.75 0 01-1.5 0v-2a.75.75 0 01.388-.657l1.996-1.1a.75.75 0 011.019.294zm9.194 0a.75.75 0 011.02-.295l1.995 1.101A.75.75 0 0118 5.75v2a.75.75 0 01-1.5 0v-.73l-.884.488a.75.75 0 11-.724-1.314l.806-.444-.806-.444a.75.75 0 01-.295-1.02zM7.343 8.284a.75.75 0 011.02-.294L10 8.893l1.638-.903a.75.75 0 11.724 1.313l-1.612.89v1.557a.75.75 0 01-1.5 0v-1.557l-1.612-.89a.75.75 0 01-.295-1.019zM2.75 11.5a.75.75 0 01.75.75v1.557l1.608.887a.75.75 0 01-.724 1.314l-1.996-1.101A.75.75 0 012 14.25v-2a.75.75 0 01.75-.75zm14.5 0a.75.75 0 01.75.75v2a.75.75 0 01-.388.657l-1.996 1.1a.75.75 0 11-.724-1.313l1.608-.887V12.25a.75.75 0 01.75-.75zm-7.25 4a.75.75 0 01.75.75v.73l.888-.49a.75.75 0 01.724 1.313l-2 1.104a.75.75 0 01-.724 0l-2-1.104a.75.75 0 11.724-1.313l.888.49v-.73a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                    </svg>
                    <span class="hidden lg:block">Curriculumn Checklist</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Curriculumn Checklist</span>
                    </div>
                </a>
                <a href="/coursecheck" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "coursecheck" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path d="M3.196 12.87l-.825.483a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.758 0l7.25-4.25a.75.75 0 000-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 01-2.276 0L3.196 12.87z" />
                        <path d="M3.196 8.87l-.825.483a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.758 0l7.25-4.25a.75.75 0 000-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 01-2.276 0L3.196 8.87z" />
                        <path d="M10.38 1.103a.75.75 0 00-.76 0l-7.25 4.25a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.76 0l7.25-4.25a.75.75 0 000-1.294l-7.25-4.25z" />
                    </svg>
                    <span class="hidden lg:block">Course Check</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Course Check</span>
                    </div>
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
                <p class="hidden lg:block text-sm my-2 text-slate-500 font-semibold px-2">File Management</p>
                <?php
                if ($_SESSION['user_type'] == "Admin") {


                ?>
                    <a href="/courses" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "courses" ? "bg-brand/5" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M9.664 1.319a.75.75 0 01.672 0 41.059 41.059 0 018.198 5.424.75.75 0 01-.254 1.285 31.372 31.372 0 00-7.86 3.83.75.75 0 01-.84 0 31.508 31.508 0 00-2.08-1.287V9.394c0-.244.116-.463.302-.592a35.504 35.504 0 013.305-2.033.75.75 0 00-.714-1.319 37 37 0 00-3.446 2.12A2.216 2.216 0 006 9.393v.38a31.293 31.293 0 00-4.28-1.746.75.75 0 01-.254-1.285 41.059 41.059 0 018.198-5.424zM6 11.459a29.848 29.848 0 00-2.455-1.158 41.029 41.029 0 00-.39 3.114.75.75 0 00.419.74c.528.256 1.046.53 1.554.82-.21.324-.455.63-.739.914a.75.75 0 101.06 1.06c.37-.369.69-.77.96-1.193a26.61 26.61 0 013.095 2.348.75.75 0 00.992 0 26.547 26.547 0 015.93-3.95.75.75 0 00.42-.739 41.053 41.053 0 00-.39-3.114 29.925 29.925 0 00-5.199 2.801 2.25 2.25 0 01-2.514 0c-.41-.275-.826-.541-1.25-.797a6.985 6.985 0 01-1.084 3.45 26.503 26.503 0 00-1.281-.78A5.487 5.487 0 006 12v-.54z" clip-rule="evenodd" />
                        </svg>
                        <span class="hidden lg:block">Course</span>
                        <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                            <span class="">Course</span>
                        </div>
                    </a>
                    <a href="/subjects" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "subjects" ? "bg-brand/5" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M10.75 16.82A7.462 7.462 0 0115 15.5c.71 0 1.396.098 2.046.282A.75.75 0 0018 15.06v-11a.75.75 0 00-.546-.721A9.006 9.006 0 0015 3a8.963 8.963 0 00-4.25 1.065V16.82zM9.25 4.065A8.963 8.963 0 005 3c-.85 0-1.673.118-2.454.339A.75.75 0 002 4.06v11a.75.75 0 00.954.721A7.506 7.506 0 015 15.5c1.579 0 3.042.487 4.25 1.32V4.065z" />
                        </svg>
                        <span class="hidden lg:block">Subjects</span>
                        <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                            <span class="">Subjects</span>
                        </div>
                    </a>
                    <a href="/curriculums" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "curriculums" ? "bg-brand/5" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M9.638 1.093a.75.75 0 01.724 0l2 1.104a.75.75 0 11-.724 1.313L10 2.607l-1.638.903a.75.75 0 11-.724-1.313l2-1.104zM5.403 4.287a.75.75 0 01-.295 1.019l-.805.444.805.444a.75.75 0 01-.724 1.314L3.5 7.02v.73a.75.75 0 01-1.5 0v-2a.75.75 0 01.388-.657l1.996-1.1a.75.75 0 011.019.294zm9.194 0a.75.75 0 011.02-.295l1.995 1.101A.75.75 0 0118 5.75v2a.75.75 0 01-1.5 0v-.73l-.884.488a.75.75 0 11-.724-1.314l.806-.444-.806-.444a.75.75 0 01-.295-1.02zM7.343 8.284a.75.75 0 011.02-.294L10 8.893l1.638-.903a.75.75 0 11.724 1.313l-1.612.89v1.557a.75.75 0 01-1.5 0v-1.557l-1.612-.89a.75.75 0 01-.295-1.019zM2.75 11.5a.75.75 0 01.75.75v1.557l1.608.887a.75.75 0 01-.724 1.314l-1.996-1.101A.75.75 0 012 14.25v-2a.75.75 0 01.75-.75zm14.5 0a.75.75 0 01.75.75v2a.75.75 0 01-.388.657l-1.996 1.1a.75.75 0 11-.724-1.313l1.608-.887V12.25a.75.75 0 01.75-.75zm-7.25 4a.75.75 0 01.75.75v.73l.888-.49a.75.75 0 01.724 1.313l-2 1.104a.75.75 0 01-.724 0l-2-1.104a.75.75 0 11.724-1.313l.888.49v-.73a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                        </svg>
                        <span class="hidden lg:block">Curriculumns</span>
                        <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                            <span class="">Curriculumns</span>
                        </div>
                    </a>
                    <a href="/users" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "users" ? "bg-brand/5" : "" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
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
                        <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                    </svg>
                    <span class="hidden lg:block">Students</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Students</span>
                    </div>
                </a>
                <p class="hidden lg:block text-sm my-2 text-slate-500 font-semibold px-2">Transaction</p>
                <a href="/coursecheck" class="hidden relative group  flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "coursecheck" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path d="M3.196 12.87l-.825.483a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.758 0l7.25-4.25a.75.75 0 000-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 01-2.276 0L3.196 12.87z" />
                        <path d="M3.196 8.87l-.825.483a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.758 0l7.25-4.25a.75.75 0 000-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 01-2.276 0L3.196 8.87z" />
                        <path d="M10.38 1.103a.75.75 0 00-.76 0l-7.25 4.25a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.76 0l7.25-4.25a.75.75 0 000-1.294l-7.25-4.25z" />
                    </svg>
                    <span class="hidden lg:block">Course Check</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Course Check</span>
                    </div>
                </a>
                <a href="/preenroll" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "coursecheck" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path d="M3.196 12.87l-.825.483a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.758 0l7.25-4.25a.75.75 0 000-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 01-2.276 0L3.196 12.87z" />
                        <path d="M3.196 8.87l-.825.483a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.758 0l7.25-4.25a.75.75 0 000-1.294l-.825-.484-5.666 3.322a2.25 2.25 0 01-2.276 0L3.196 8.87z" />
                        <path d="M10.38 1.103a.75.75 0 00-.76 0l-7.25 4.25a.75.75 0 000 1.294l7.25 4.25a.75.75 0 00.76 0l7.25-4.25a.75.75 0 000-1.294l-7.25-4.25z" />
                    </svg>
                    <span class="hidden lg:block">Course Check</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Course Check</span>
                    </div>
                </a>

                <p class="hidden lg:block text-sm my-2 text-slate-500 font-semibold px-2">System Settings</p>
                <a href="/schoolyears" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "schoolyears" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                    </svg>
                    <span class="hidden lg:block">School Year</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">School Year</span>
                    </div>
                </a>
                <a href="/semesters" class="relative group flex flex-col lg:flex-row lg:items-center gap-1 px-3 py-2 hover:bg-brand/10 rounded-lg <?= $GLOBALS['currentpage'] == "semesters" ? "bg-brand/5" : "" ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                    </svg>
                    <span class="hidden lg:block">Semesters</span>
                    <div class="tooltip text-sm whitespace-nowrap hidden z-10 group-hover:block lg:group-hover:hidden absolute left-full top-0  w-fit px-3 py-2 rounded-lg text-slate-50 bg-slate-700/80 backdrop-blur-md">
                        <span class="">Semesters</span>
                    </div>
                </a>


            <?php

            endif;

            ?>
        </div>
    </div>
    <div class="px-4 py-2 flex flex-row gap-2 justify-center items-center mb-4">
        <p class="text-sm text-slate-500">&copy; <span class="hidden lg:inline-block">Pangasinan State University</span></p>
    </div>
</aside>
<div class="relative h-screen overflow-y-auto flex-auto flex gap-6 flex-col">
    <!-- topbard -->
    <div class="sticky top-0 px-8 py-2 flex flex-row justify-between items-center bg-white shadow-lg shadow-black/5">
        <div class="flex flex-row items-center gap-4">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm7 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        <div class="flex flex-row gap-4 p-2 items-center">

            <div class="relative group">
                <a href="#" class="p-2">
                    <?= $userdata->getFname() ?>
                </a>
                <div class="hidden group-hover:block absolute right-0 w-52 min-w-fit rounded-xl bg-white border border-slate-700/10 shadow-lg shadow-black/5 ">

                    <a href="/settings" class="flex flex-row gap-2 hover:bg-brand/20 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span>Account Settings</span>
                    </a>

                    <a href="/out" class="flex flex-row gap-2 hover:bg-brand/20 p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>

                        <span>Log out</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- topbard -->

    <div class="px-8">
        <h2 class="text-2xl font-semibold mb-1"><?= ucfirst($pageTitle) ?></h2>
        <div class="text-sm text-slate-500"><?= $pageDesc ?></div>
    </div>