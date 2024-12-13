<?php

namespace Helpers\Data;

use DateTime;
use Exception;

class AgeHelper
{
    public static function getUsia(DateTime $lahir, DateTime $now): int
    {
        // Tidak boleh diluar zona waktu Indonesia //revisi
        // $lahir->getTimezone()->getName() == "Asia/Jakarta" ? null : throw new Exception("Timezone tidak sesuai");

        $usia = $lahir->format('Y') - $now->format('Y');

        if (!self::hasPassedBirthday($lahir, $now)) {
            $usia -= 1;
        }

        return $usia;
    }

    public static function hasPassedBirthday(DateTime $lahir, DateTime $now): bool
    {
        $value = ($lahir > $now) ? true : false;
        return $value;
    }
}
