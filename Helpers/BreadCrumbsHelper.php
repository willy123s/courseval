<?php

namespace Makkari\Helpers;

function Breadcrumb($currentPageKey)
{
    $pages = [
        '' => 'Dashboard',
        'departments' => 'Departments',
        'courses' => 'Courses',
        'subjects' => 'Subjects',
    ];

    // Get the current page key (you may retrieve it dynamically based on your application logic)


    // Create breadcrumb trail
    $breadcrumb = [];
    foreach ($pages as $key => $title) {
        $breadcrumb[] = ($key === $currentPageKey) ? $title : "<a href='/$key'>$title</a>";
    }
    return implode(' / ', $breadcrumb);
}
