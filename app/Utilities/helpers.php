<?php

if (!function_exists('getReference')) {
    /**
     * @param int $lengthOfString
     * @return string
     */
    function getReference(int $lengthOfString = 15): string
    {
        $strResult = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($strResult), 0, $lengthOfString);
    }
}
