<?php

use NumberToWords\NumberToWords;

if (!function_exists('convertNumberToWords')) {
    function convertNumberToWords($number) {
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        return strtoupper($numberTransformer->toWords($number)) . ' TAKA ONLY';
    }
}