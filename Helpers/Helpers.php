<?php

namespace Makkari\Helpers;

function esc($value)
{
    // Use htmlspecialchars to escape the value
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
