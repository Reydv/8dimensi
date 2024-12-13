<?php

namespace Helpers\Data;

class StringHelper
{
    public static function replaceDate($date)
    {
        $englishDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $indonesianDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        $englishMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $indonesianMonths = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        // Replace English day and month names with Indonesian names
        $dateString = str_replace($englishDays, $indonesianDays, $date);
        $dateString = str_replace($englishMonths, $indonesianMonths, $dateString);
        return $dateString;
    }

    public static function pickFirstWord($string)
    {
        $words = explode(" ", $string); 
        $firstWord = $words[0];

        return $firstWord;
    }

    public static function cleanName($string){
        $lowercaseString = strtolower($string);
        $capitalizedString = ucwords($lowercaseString);
        $trimmedString = trim($capitalizedString);
        $finalString = preg_replace('/\s+/', ' ', $trimmedString);

        return $finalString;
    }
}
