<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\EmailAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(15)->create();
        \App\Models\Event::factory(5)->create();
        \App\Models\Jawaban::factory(70)->create();

        EmailAdmin::create([
            'email_admin' => 'admin@gmail.com'
        ]);

        // User::create([
        //     'name' => 'globglogalgalab',
        //     'tanggal_lahir' => '2006-05-23',
        //     'jenis_kelamin' => '',
        //     'email' => 'admin@gmail.com',
        //     'notelp' => '08417074217421',
        //     'pendidikan_terakhir' => 'SMA',
        //     'status' => 'Pelajar',
        //     'institusi' => 'Telkom',
        //     'jurusan' => 'jaringan',
        //     'perusahaan' ,
        //     'jabatan',
        //     'masa_kerja',
        //     'password' => '123',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'admin@gmail.com',
            'password' => '123'
        ]);
    }
}
