<?php

class NavigationLink {
    public static function generate($pageLink, $title, $iconImage = "", $aProperties = "") {
        $icon = "";
        if ($iconImage != "") {
            $icon = "<img src='$iconImage' alt=''>";
        }

        return "
            <li>
                <a href='$pageLink' $aProperties>
                    $icon
                    <span class='widescreen-only'>$title</span>
                </a>
            </li>
        ";
    }
}