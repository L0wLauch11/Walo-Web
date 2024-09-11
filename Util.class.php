<?php

class Util {
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

    public static function curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}