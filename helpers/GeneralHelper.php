<?php

namespace Helpers;

use Illuminate\Database\Eloquent\Model;

class GeneralHelper
{
    public static function isBetweenAnd(int $value, int $min, int $max): bool
    {
        return $value >= $min && $value <= $max;
    }

    public static function returnUniqueModelsOnly($models)
    {
        $uniqueModels = [];

        foreach ($models as $model) {
            if ($model instanceof Model) {
                if (!isset($uniqueModels[$model->getKey()])) {
                    $uniqueModels[$model->getKey()] = $model;
                }
            }
        }

        return (object) $uniqueModels;
    }
}
