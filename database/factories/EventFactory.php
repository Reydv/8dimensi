<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $arrayOfInstitution = [' Institusi', ' Inc.'];
        $institution = $arrayOfInstitution[array_rand($arrayOfInstitution)];

        $arrayOfExpired = [true, false];
        $isExpired = $arrayOfExpired[array_rand($arrayOfExpired)];

        $arrayOfGoal = ['personaldev', 'careerdev'];
        $goal = $arrayOfGoal[array_rand($arrayOfGoal)];

        $randDate = '202' . rand(3, 5) . '-0' . rand(2, 9) . '-' . rand(10, 30);
        return [
            'nama' => fake()->name(),
            'kode_akses' => fake()->password(5, 6),
            'institusi' => fake()->city() . $institution,
            'tanggal_mulai' => Carbon::parse('2023-01-01 15:00:00'),
            'tanggal_selesai' => Carbon::parse($randDate . ' 15:00:00'),
            'tujuan_tes' => $goal,
            'deskripsi' => fake()->text('100'),
            'is_answers_hold' => false
        ];
        // fake()->dateTime("now", "Asia/Jakarta")
    }
}
