<?php

namespace Makkari\Controllers;

use Makkari\Controllers\Controller;

class Msgbox extends Controller
{
    private $title;
    private $message;
    private $target;
    private $targetid;
    private $type;
    private $showYesNoButtons;
    private $icontype;

    public function __construct($title, $message, $target, $targetid, $type = 0, $icontype = "default", $showYesNoButtons = true)
    {
        $this->title = $title;
        $this->message = $message;
        $this->target = $target;
        $this->targetid = $targetid;
        $this->type = $type;
        $this->icontype = $icontype;
        $this->showYesNoButtons = $showYesNoButtons;
    }

    public function render()
    {
        $textcolor = "";
        $bgcolor = "";
        $btncolor = "";
        $icon = "";
        switch ($this->icontype) {
            case 'question':
                $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
              </svg>';
                break;
            case 'warning':
                $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
              </svg>';
                break;
            case 'danger':
                $icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
              </svg>';
                break;
            default:
                $icon = '';
                break;
        }
        switch ($this->type) {
            case 0:
                $textcolor = "";
                $bgcolor = "";
                $btncolor = "bg-brand hover:bg-brand-dark";

                break;
            case 1:
                $textcolor = "text-success-dark";
                $bgcolor = "bg-success-dark/20";
                $btncolor = "bg-success hover:bg-success-dark";
                break;
            case 2:
                $textcolor = "text-warning-dark";
                $bgcolor = "bg-warning-dark/20";
                $btncolor = "bg-warning hover:bg-warning-dark";
                break;
            case 3:
                $textcolor = "text-danger-dark";
                $bgcolor = "bg-danger-dark/20";
                $btncolor = "bg-danger hover:bg-danger-dark";
                break;

            default:
                $textcolor = "";
                $bgcolor = "";
                break;
        }


        $msg = "";
        $msg .= "<h2 class='text-xl font-semibold mb-4'>{$this->title}</h2>";
        $msg .= "<p class='p-2 rounded-lg flex flex-col justify-center items-center {$textcolor} {$bgcolor}'>
                {$icon}
                <span>{$this->message}</span></p>";
        $msg .= "<form action='/{$this->target}' method='POST'>";
        $msg .= "<div class='flex justify-end mt-4' >";
        $msg .= "<input type='hidden' name='csrf_token' value='{$_SESSION['csrf_token']}'>";
        $msg .= "<input type='hidden' name='id' value='{$this->targetid}'>";
        if ($this->showYesNoButtons) {
            $msg .= "<button id='confirm-delete-btn' class='{$btncolor}  text-white px-4 py-2 rounded-md mr-2'>Yes</button>";
            $msg .= "<button type='button' id='cancel-btn' class='close bg-slate-700/10 hover:bg-slate-700/20  px-4 py-2 rounded-md  transition-colors'>
            No</button>";
        } else {
            $msg .= "<button type='button' id='cancel-btn' class='close bg-slate-700/10 hover:bg-slate-700/20  px-4 py-2 rounded-md mr-2 transition-colors'>
            Ok</button>";
        }
        $msg .= "</div>";
        $msg .= "</form>";
        echo $msg;
    }
}
