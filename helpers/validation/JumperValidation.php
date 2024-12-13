<?php

namespace Helpers\Validation;

class JumperValidation
{
    // return true if jump
    public static function isJumpingSubmit($answerID)
    {
        $answer = session('answers-' . $answerID);

        if (empty($answer)) {
            return true;
        }

        if (!$answer['checkbox'] && !$answer['range']) {
            return true;
        }

        Validation::removeArrayNullValues($answer);

        if (count($answer['checkbox']['p']) != 24 && count($answer['checkbox']['t']) != 24) {
            return true;
        }

        if (count($answer['range']) != 20) {
            return true;
        }

        return false;
    }

    // return true if jump
    public static function isJumping($answerID, $destination)
    {
        if ($destination == 'section-1-1'){
            return false;
        }

        $isInSection2 = false;
        $questionMustAnswered = 0;
        $answer = session('answers-' . $answerID, null);

        if (empty($answer)) {
            return true;
        }

        switch ($destination) {
            case "section-1-2":
                $questionMustAnswered = 8;
                break;
            case "section-1-3":
                $questionMustAnswered = 16;
                break;
            case "section-wait":
            case "section-2-1":
                $isInSection2 = true;
                break;
            case "section-2-2":
                $isInSection2 = true;
                $questionMustAnswered = 10;
                break;
        }

        if ($isInSection2 == true) {
            if (!$answer['checkbox'] && !$answer['range']) {
                return true;
            }

            Validation::removeArrayNullValues($answer);

            if (count($answer['checkbox']['p']) < 24 && count($answer['checkbox']['t']) < 24) {
                return true;
            }

            if (count($answer['range']) < $questionMustAnswered) {
                return true;
            }
        } else {
            if (!$answer['checkbox']) {
                return true;
            }

            Validation::removeArrayNullValues($answer);

            if (count($answer['checkbox']['p']) < $questionMustAnswered && count($answer['checkbox']['t']) < $questionMustAnswered) {
                return true;
            }
        }

        return false;
    }
}
