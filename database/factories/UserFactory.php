<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arrayOfPendidikan = ["sd", "smp", "sma", "smk", "d1", "d2", "d3", "d4", "s1", "s2", "s3"];
        $pendidikan = $arrayOfPendidikan[array_rand($arrayOfPendidikan)];
        
        $arrayOfGender = ["laki", "perempuan"];
        $gender = $arrayOfGender[array_rand($arrayOfGender)];

        $coreData = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'tanggal_lahir' => fake()->dateTimeAD("now", "Asia/Jakarta"),
            'domisili' => fake()->city() . ', ' . fake()->state(),
            'jenis_kelamin' => $gender,
            'notelp' => fake()->phoneNumber(),
            'usia' => rand(15, 69),
            'pendidikan_terakhir' => $pendidikan,

        ];

        $etc = [
            'email_verified_at' => now(),
            'password' => bcrypt(fake()->password(5, 8)),
            'remember_token' => Str::random(10),
        ];

        $arrayOfJurusan = ['Ilmu Pendidikan', 'Ilmu Pengetahuan Alam dan Matematika', 'Soshum', 'Informatika', 'Kedokteran dan Kesehatan', 'Hukum', 'Seni dan Desain', 'Komputer'];
        $jurusan = $arrayOfJurusan[array_rand($arrayOfJurusan)];

        $dataStatus = [
            [
                'status' => 1,
                'institusi' => fake()->city() . " Institution",
                'jurusan' => $jurusan
            ],
            [
                'status' => 2,
                'perusahaan' => fake()->company(),
                'jabatan' => fake()->jobTitle(),
                'masa_kerja' => rand(0, 30)
            ]
        ];

        $finalUserArray = array_merge($coreData, $dataStatus[array_rand($dataStatus)], $etc);

        return $finalUserArray;
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
