<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jawaban>
 */
class JawabanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        /**
         * GENERATE THE 1 ST SECTION ANSWERS
         */

        $mostValue = [0, 0, 0, 0];
        $leastValue = [0, 0, 0, 0];

        $maxChanceOfMost = [20, 18, 19, 15];
        $maxChanceOfLeast = [19, 19, 20, 16];

        $discArray = [
            0 => 'd',
            1 => 'i',
            2 => 's',
            3 => 'c'
        ];
        $dice = 0;

        /**
         * Loop to create the least value
         */
        for ($i = 0; $i < 24; $i++) {

            $dice = array_rand($discArray);

            if ($maxChanceOfMost[$dice] == 0) {
                $altDice = $this->getAnotherJawabanValue($dice);
                $mostValue[$altDice] += 1;
                $maxChanceOfMost[$altDice] -= 1;
                continue;
            }

            $mostValue[$dice] += 1;
            $maxChanceOfMost[$dice] -= 1;
        }

        /**
         * Loop to create the least value
         */
        for ($i = 0; $i < 24; $i++) {

            $dice = array_rand($discArray);

            if ($maxChanceOfLeast[$dice] == 0) {
                $altDice = $this->getAnotherJawabanValue($dice);
                $leastValue[$altDice] += 1;
                $maxChanceOfLeast[$altDice] -= 1;
                continue;
            }

            $leastValue[$dice] += 1;
            $maxChanceOfLeast[$dice] -= 1;
        }

        // Calculate the change value  
        $changeValue = array_map(fn ($most, $least) => $most - $least, $mostValue, $leastValue);

        /**
         * GENERATE THE 2 ND SECTION ANSWERS
         */

        $section2Answer = array_map(fn () => random_int(1, 10), range(1, 5));


        // Finale declaration
        $type1FormattedValue = [
            'most_value' => $mostValue,
            'least_value' => $leastValue,
            'change_value' => $changeValue
        ];
        $type2FormattedValue = [
            'value' => $section2Answer
        ];

        // Leadership dimension
        $arrayOfimensions = ['Pelopor', 'Tegas', 'Pemikir', 'Inklusif', 'Rendah Hati', 'Afirmasi', 'Penggerak', 'Berwibawa'];
        $dimension = $arrayOfimensions[array_rand($arrayOfimensions)];

        return [
            'user_id' => random_int(1, 10),
            'event_id' => random_int(1, 5),
            'dimensi_kepemimpinan' => $dimension,
            'type1_formatted_value' =>  json_encode($type1FormattedValue),
            'type2_formatted_value' =>  json_encode($type2FormattedValue),
            'progress' => 'selesai'
        ];
    }

    private function getAnotherJawabanValue(int $forbiddenIndex): int
    {
        $discArray = [
            0 => 'd',
            1 => 'i',
            2 => 's',
            3 => 'c'
        ];

        unset($discArray[$forbiddenIndex]);
        return array_rand($discArray);
    }
}
