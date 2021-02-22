<?php
class Helper {
    function toCamelCase($str){
        $first_letter = $str[0];
        $str_data = str_replace(" ", "", ucwords(str_replace(["-", "_"], " ", $str)));
        $str_data[0] = $first_letter;
        return $str_data;
    }

    function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}