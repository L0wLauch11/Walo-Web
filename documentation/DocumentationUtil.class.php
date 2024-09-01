<?php

class DocumentationUtil {
    public static function renderPhp($path) {
        ob_start();
        include $path;
        $var = ob_get_contents(); 
        ob_end_clean();

        return $var;
    }
    
    public static function sanitizeText($text, $allowedChars) {
        $newText = '';
        $textChars = str_split(strtolower($text));
    
        foreach ($textChars as $char) {
            if (str_contains($allowedChars, $char)) {
                $newText .= $char;
            }
        }
    
        return $newText;
    }
}