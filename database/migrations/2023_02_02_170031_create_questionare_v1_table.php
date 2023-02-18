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
        Schema::create('questionnaire_v1', function (Blueprint $table) {
            $table->id();
            $table->boolean('med_care')->nullable();
            $table->string('bd_class')->nullable();
            
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('s1_id')->nullable();
            $table->text('s2_id')->nullable();
            $table->text('s3_id')->nullable();
            $table->text('s4_id')->nullable();
            $table->text('s5_id')->nullable();
            $table->text('transaction_id')->nullable();
            $table->text('aff_id')->nullable();
            $table->text('off_id')->nullable();
            $table->text('universal_leadid')->nullable();
            $table->text('xxTrustedFormToken')->nullable();
            $table->text('xxTrustedFormCertUrl')->nullable();
            $table->text('xxTrustedFormPingUrl')->nullable();
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
        Schema::dropIfExists('questionare_v1');
    }
};
