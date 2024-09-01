<?php

class Heading {
    public static function generate($headingTag, $text) {
        $allowedIdChars = 'abcdefghijklmnopqrstuvwxyz';
        $idText = DocumentationUtil::sanitizeText($text, $allowedIdChars);

        return "<$headingTag id='$idText'>$text</$headingTag>";
    }
}