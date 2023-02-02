<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionare', function (Blueprint $table) {
            $table->id();
            
            $table->boolean('med_care')->nullable();
            $table->integer('bd_month')->nullable();
            $table->integer('bd_day')->nullable();
            $table->integer('bd_year')->nullable();
            $table->mediumText('zip_code')->nullable();
            $table->boolean('rc_benefits')->nullable();
            $table->boolean('last_employed')->nullable();
            /**
            *     'country' => 'nullable|string',
            *'state' => 'nullable|string',
            *'city' => 'nullable|string',
            *aff_id
            */
            $table->text('country')->nullable();
            $table->text('state')->nullable();
            $table->text('city')->nullable();

            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
            $table->text('address')->nullable();
            $table->text('s1_id')->nullable();
            $table->text('s2_id')->nullable();
            $table->text('s3_id')->nullable();
            $table->text('s4_id')->nullable();
            $table->text('s5_id')->nullable();
            $table->text('transaction_id')->nullable();
            $table->text('aff_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionare');
    }
};
