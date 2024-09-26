<?php

class NavigationLink {
    public static function generate($pageLink, $title, $iconImage = "") {
        $icon = "";
        if ($iconImage != "") {
            $icon = "<img src='$iconImage' alt='Icon'>";
        }

        $isCurrent = "";
        if (str_contains($_SERVER['REQUEST_URI'], $pageLink)) {
            $isCurrent = 'current-page';
        }

        return <<<HTML
            <li class="$isCurrent">
                <a href="$pageLink">
                    $icon
                    <span class='widescreen-only'>$title</span>
                </a>
            </li>
        HTML;
    }
}