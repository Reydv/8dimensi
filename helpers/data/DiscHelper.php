<?php

namespace Helpers\Data;

use Exception;

class DiscHelper
{

    public static function formatDiscValue(array $values): String
    {
        if (empty($values) | count($values) != 4) {
            throw new Exception("Format array tidak valid");
        }

        $result = "";

        foreach ($values as $value) {
            $result = $result . (string)$value;
        }

        return $result;
    }

    public static function getChangeValue(array $most, array $least): array
    {
        if (count($most) != 4 | count($least) != 4) {
            throw new Exception("Data yang dikirim tidak valid");
        }

        $result = [];

        for ($i = 0; $i <= 3; $i++) {
            $result[] = $most[$i] - $least[$i];
        }

        return $result;
    }

    public static function getRawChangeValue(array $most, array $least): array
    {
        if (count($most) != 4 | count($least) != 4) {
            throw new Exception("Data yang dikirim tidak valid");
        }

        $result = [];

        for ($i = 0; $i <= 3; $i++) {
            $result[] = $most[$i] - $least[$i];
        }

        return $result;
    }

    public static function deformatDiscValue(string $disc): array
    {
        if (strlen($disc) != 4) {
            throw new Exception("Data yang dikirim tidak valid");
        }

        $result = [];

        foreach (str_split($disc) as $value) {
            $result[] = (int)$value;
        }

        return $result;
    }

    public static function normalizeDiscValue(array $values): array
    {
        if (empty($values)) {
            throw new Exception("Array DISC kosong");
        }

        $D = 0;
        $I = 0;
        $S = 0;
        $C = 0;

        foreach ($values as $value) {
            $D += ($value == "d") ? 1 : 0;
            $I += ($value == "i") ? 1 : 0;
            $S += ($value == "s") ? 1 : 0;
            $C += ($value == "c") ? 1 : 0;
        }

        $result = [$D, $I, $S, $C];
        return $result;
    }

    public static function normalizeAndFormatDiscValue(array $values): string
    {
        $result = self::formatDiscValue(self::normalizeDiscValue($values));
        return $result;
    }

    public static function calculateGraphValue(array $disc, array $graph): string
    {
        $finalDisc = [];
        foreach ($graph as $index => $values) {
            $finalDisc[] = $values[$disc[$index]];
        }

        $biggestValue = 0;
        $biggestIndex = 0;

        foreach ($finalDisc as $index => $value) {
            $biggestIndex = $value > $biggestValue ? $index + 1 : $biggestIndex;
            $biggestValue = $value > $biggestValue ? $value : $biggestValue;
        }

        $finalBiggestDisc = null;
        switch ($biggestIndex) {
            case 1:
                $finalBiggestDisc = 'd';
                break;
            case 2:
                $finalBiggestDisc = 'i';
                break;
            case 3:
                $finalBiggestDisc = 's';
                break;
            case 4:
                $finalBiggestDisc = 'c';
                break;
        }
        return $finalBiggestDisc;
    }

    public static function decideDimension(string $graph2Value, string $graph3Value): string
    {
        $keyword = $graph2Value . $graph3Value;
        $dimension = null;

        if ($keyword == 'di' || $keyword == 'id') {
            $dimension = "Pelopor";
        } else if ($keyword == 'ii') {
            $dimension = "Penggerak";
        } else if ($keyword == 'is' || $keyword == 'si') {
            $dimension = "Afirmasi";
        } else if ($keyword == 'ss') {
            $dimension = "Inklusif";
        } else if ($keyword == 'sc' || $keyword == 'cs') {
            $dimension = "Rendah Hati";
        } else if ($keyword == 'cc') {
            $dimension = "Pemikir";
        } else if ($keyword == 'cd' || $keyword == 'dc') {
            $dimension = "Tegas";
        } else if ($keyword == 'dd') {
            $dimension = "Berwibawa";
        }

        return $dimension;
    }

    public static function checkInconsistent(string $graph2Value, string $graph3Value)
    {
        $keyword = $graph2Value . $graph3Value;
        $dimension = null;

        if ($keyword == 'ds') {
            $dimension = ["Pelopor", "ds"];
        } else if ($keyword == 'sd') {
            $dimension = ["Rendah Hati", 'sd'];
        } else if ($keyword == 'ic') {
            $dimension = ["Penggerak", 'ic'];
        } else if ($keyword == 'ci') {
            $dimension = ["Pemikir", 'ci'];
        } 

        return $dimension;
    }
}
