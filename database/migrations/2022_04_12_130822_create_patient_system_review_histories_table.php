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
        Schema::create('patient_system_review_histories', function (Blueprint $table) {
            $table->id();
            $table->text('musculoskeletal')->nullable();
            $table->text('respiratory')->nullable();
            $table->text('cardiovascular')->nullable();
            $table->text('gastrointestinal')->nullable();
            $table->text('genitourinary')->nullable();
            $table->text('central_nervous')->nullable();
            $table->text('endocrine')->nullable();
            $table->foreignId('patient_visit_id')->constrained();
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
        Schema::dropIfExists('patient_system_review_histories');
    }
};
