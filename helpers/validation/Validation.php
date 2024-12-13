<?php

namespace Helpers\Validation;

use Exception;
use App\Models\Event;
use App\Models\EmailAdmin;
use App\Models\Jawaban;
use Ramsey\Uuid\Type\Integer;
use Carbon\Carbon;

class Validation
{

    // perlu testing
    public static function isUserExistIn($userId, $eventId)
    {
        $answer = Jawaban::where('event_id', '=', $eventId)
            ->where('user_id', '=', $userId)
            ->first();
        $isAlreadyAnswered = false;

        if ($answer) {
            $isAlreadyAnswered = $answer->progress == 'Selesai';
        }

        return $isAlreadyAnswered ? true : false;

        // $jawabans = $event->jawabans();

        // foreach ($jawabans as $jawaban) {
        //     if ($jawaban->user()->id == $userId && $jawaban->progress == "Selesai") {
        //         throw new Exception('Anda sudah mengisi');
        //     }
        // }
    }

    // Return true if admin
    public static function isAdmin($email): bool
    {
        foreach (EmailAdmin::all() as $emailAdmin) {
            if ($email == $emailAdmin->email_admin) {
                return true;
            }
        }
        return false;
    }

    public static function returnIfInt($intValue, $variableMessage = 'value'): int
    {
        if (!is_int($intValue)) {
            throw new Exception($variableMessage . ' harus berupa angka');
        }
        return $intValue;
    }

    public static function returnIfString($strValue, $variableMessage = 'value'): string
    {
        if (!is_string($strValue)) {
            throw new Exception($variableMessage . ' harus berupa string');
        }
        return $strValue;
    }

    public static function removeArrayNullValues(&$array) {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                self::removeArrayNullValues($value);
            } else {
                if ($value === null) {
                    unset($array[$key]);
                }
            }
        }
    }

    public static function isEventExpired($startDate, $expirationDate) {
        $currentDate = Carbon::now();

        $isExpired = $currentDate > $expirationDate;

        return $isExpired;
    }
    
    public static function isEventNotStarted($startDate, $expirationDate) {
        $currentDate = Carbon::now();

        $isExpired = $currentDate < $startDate ;

        return $isExpired;
    }
}
