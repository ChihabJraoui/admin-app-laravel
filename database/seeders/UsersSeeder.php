<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fullname' => 'Jack Ma',
            'email' => 'jack.ma@email.com',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'fullname' => 'Bill Gates',
            'email' => 'bill.gates@email.com',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now()
        ]);
    }
}
