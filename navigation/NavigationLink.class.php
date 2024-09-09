<?php

class NavigationLink {
    public static function generate($pageLink, $title, $iconImage = "", $aProperties = "") {
        $icon = "";
        if ($iconImage != "") {
            $icon = "<img src='$iconImage' alt=''>";
        }

        $isCurrent = "";
        if (str_contains($_SERVER['REQUEST_URI'], $pageLink)) {
            $isCurrent = 'current-page';
        }

        return "
            <li class='$isCurrent'>
                <a href='$pageLink'>
                    $icon
                    <span class='widescreen-only'>$title</span>
                </a>
            </li>
        ";
    }
}