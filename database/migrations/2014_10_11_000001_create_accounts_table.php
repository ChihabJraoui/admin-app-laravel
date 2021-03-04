<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();

            $table->string('name');
            $table->boolean('is_main_account')->default(true);

            $table->string('investment_type');
            $table->string('investment_range');
            $table->string('accredited_investor');

            $table->unsignedFloat('principal')->nullable();
            $table->unsignedFloat('interest_rate')->nullable();
            $table->integer('period_in_years')->nullable();

            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('declined_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
