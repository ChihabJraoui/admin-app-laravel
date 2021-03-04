<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statements')->insert([
            'account_id' => 1,
            'amount' => 6000.00,
            'created_at' => Carbon::now()
        ]);
    }
}
