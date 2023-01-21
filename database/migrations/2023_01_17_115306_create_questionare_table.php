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
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
            $table->text('address')->nullable();
            $table->integer('s1_id')->nullable();
            $table->integer('s2_id')->nullable();
            $table->integer('s3_id')->nullable();
            $table->integer('s4_id')->nullable();
            $table->integer('s5_id')->nullable();
            $table->integer('transaction_id')->nullable();
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
