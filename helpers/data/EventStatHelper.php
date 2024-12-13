<?php

namespace Helpers\Data;

use Helpers\Validation\Validation;
use Helpers\GeneralHelper;

class EventStatHelper
{

    public static function calculateGenderDispersion($users): array
    {
        // Gender Category = ['laki', 'perempuan']
        $usersGender = [0, 0];

        foreach ($users as $user) {
            $userGender = Validation::returnIfString($user, 'Jenis kelamin');
            $userGender = strtolower($user);

            switch ($userGender) {
                case 'laki':
                    $usersGender[0] += 1;
                    break;
                case 'perempuan':
                    $usersGender[1] += 1;
                    break;
            }
        }

        return $usersGender;
    }

    public static function calculateAgeDispersion($users)
    {
        // Age Category = ['<15', '15-20', '20-30', '30-40', '40-50', '50>']
        $usersAge = [0, 0, 0, 0, 0, 0];

        foreach ($users as $user) {
            $userAge = Validation::returnIfInt((int)$user, 'Usia');

            if ($userAge < 15) {
                $usersAge[0] += 1;
            } else if (GeneralHelper::isBetweenAnd($userAge, 15, 20)) {
                $usersAge[1] += 1;
            } else if (GeneralHelper::isBetweenAnd($userAge, 20, 30)) {
                $usersAge[2] += 1;
            } else if (GeneralHelper::isBetweenAnd($userAge, 30, 40)) {
                $usersAge[3] += 1;
            } else if (GeneralHelper::isBetweenAnd($userAge, 40, 50)) {
                $usersAge[4] += 1;
            } else if ($userAge > 50) {
                $usersAge[5] += 1;
            }
        }

        return $usersAge;
    }

    public static function calculateEducationDispersion($users): array
    {
        // Education Category = ['sd', 'smp', 'sma', 'smk', 'd1', 'd2', 'd3', 'd4', 's1', 's2', 's3']
        $usersEducation = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($users as $user) {
            $userEducation = Validation::returnIfString($user, 'Pendidikan terakhir');
            $userEducation = strtolower(str_replace([' ', "\t", "\n", "\r"], '', $userEducation));

            switch ($userEducation) {
                case 'sd':
                    $usersEducation[0] += 1;
                    break;
                case 'smp':
                    $usersEducation[1] += 1;
                    break;
                case 'sma':
                    $usersEducation[2] += 1;
                    break;
                case 'smk':
                    $usersEducation[3] += 1;
                    break;
                case 'd1':
                    $usersEducation[4] += 1;
                    break;
                case 'd2':
                    $usersEducation[5] += 1;
                    break;
                case 'd3':
                    $usersEducation[6] += 1;
                    break;
                case 'd4':
                    $usersEducation[7] += 1;
                    break;
                case 's1':
                    $usersEducation[8] += 1;
                    break;
                case 's2':
                    $usersEducation[9] += 1;
                    break;
                case 's3':
                    $usersEducation[10] += 1;
                    break;
            }
        }

        return $usersEducation;
    }

    public static function calculateResidenceDispersion($users): array
    {
        /**
         * ~ Size depends on users resident dispersion
         * ~ Filtered by number
         * Residence Category = ['X1' => 14, 'X2' => 7, 'X3' => 4]
         */
        $usersResidence = [];
        foreach ($users as $user) {
            $userResidence = Validation::returnIfString($user, 'Domisili');

            if (!isset($usersResidence[$userResidence])) {
                $usersResidence[$userResidence] = 1;
            } else {
                $usersResidence[$userResidence] += 1;
            }
        }

        arsort($usersResidence);
        $usersResidence  = array_slice($usersResidence, 0, 5);
        return $usersResidence;
    }

    public static function calculate8DimensionsDispersion($answers): array
    {
        // 8 Dimensions Category = ['Pelopor', 'Penggerak', 'Afirmasi', 'Inklusif', 'Rendah Hati', 'Pemikir', 'Tegas', 'Berwibawa']
        $answersDimension = [0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($answers as $answer) {
            if (empty($answer)) {
                continue;
            }
            $answerDimension = Validation::returnIfString($answer, 'Dimensi kepemimpinan');
            $answerDimension = strtolower(str_replace([' ', "\t", "\n", "\r"], '', $answerDimension));

            switch ($answerDimension) {
                case 'pelopor':
                    $answersDimension[0] += 1;
                    break;
                case 'penggerak':
                    $answersDimension[1] += 1;
                    break;
                case 'afirmasi':
                    $answersDimension[2] += 1;
                    break;
                case 'inklusif':
                    $answersDimension[3] += 1;
                    break;
                case 'rendahhati':
                    $answersDimension[4] += 1;
                    break;
                case 'pemikir':
                    $answersDimension[5] += 1;
                    break;
                case 'tegas':
                    $answersDimension[6] += 1;
                    break;
                case 'berwibawa':
                    $answersDimension[7] += 1;
                    break;
            }
        }

        return $answersDimension;
    }
}
