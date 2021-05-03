<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => "Super Admin",
            'email' => "admin@sida.com",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $schools = array(
            array('SD Negeri 001 Bontang Utara','sd'),
            array('SD Negeri 002 Bontang Utara','sd'),
            array('SD Negeri 003 Bontang Utara','sd'),
            array('SD Negeri 006 Bontang Utara','sd'),
            array('SD Negeri 001 Bontang Selatan','sd'),
            array('SD Negeri 002 Bontang Selatan','sd'),
            array('SD Negeri 003 Bontang Selatan','sd'),
            array('SMP Negeri 1','smp'),
            array('SMP Negeri 2','smp'),
            array('SMP Negeri 3','smp'),
            array('SMP Negeri 4','smp'),
        );

        foreach ($schools as $school) {
            School::create([
                'name' => $school[0],
                'level' => $school[1],
            ]);
        }
        \App\Models\School::factory(10)->create();
        \App\Models\Student::factory(10)->create();
        \App\Models\User::factory(10)->create();
    }
}
