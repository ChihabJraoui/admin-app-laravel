<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * User 1
         * Account 1
         */
        DB::table('accounts')->insert([
            'user_id' => 1,
            'name' => 'Main Account',
            'investment_type' => 'Individual',
            'investment_range' => '$100,000 - $500,000',
            'accredited_investor' => 'Unsure',
            'approved' => false,
            'created_at' => Carbon::now()
        ]);

        /*
         * User 1
         * Account 2
         */
        DB::table('accounts')->insert([
            'user_id' => 1,
            'name' => 'For Wife',
            'investment_type' => 'Individual',
            'investment_range' => '$10,000 - $50,000',
            'accredited_investor' => 'Unsure',
            'approved' => false,
            'created_at' => Carbon::now()
        ]);

        /*
         * User 1
         * Account 3
         */
        DB::table('accounts')->insert([
            'user_id' => 2,
            'name' => 'Main Account',
            'investment_type' => 'Individual',
            'investment_range' => '$100,000 - $500,000',
            'accredited_investor' => 'Unsure',
            'approved' => false,
            'created_at' => Carbon::now()
        ]);
    }
}
