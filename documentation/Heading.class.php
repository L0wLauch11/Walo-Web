<?php

class Heading {
    public static function generate($headingTag, $text): string {
        $allowedIdChars = 'abcdefghijklmnopqrstuvwxyz';
        $idText = Util::sanitizeText($text, $allowedIdChars);

        return "<$headingTag id='$idText'>$text</$headingTag>";
    }
}