<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),

            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'created_at' => Carbon::now()
        ]);

        DB::table('admins')->insert([
            'username' => 'chihabjraoui',
            'email' => 'chihabajraoui@gmail.com',
            'password' => bcrypt('password'),

            'firstname' => 'Chihab',
            'lastname' => 'Jraoui',
            'created_at' => Carbon::now()
        ]);
    }
}
