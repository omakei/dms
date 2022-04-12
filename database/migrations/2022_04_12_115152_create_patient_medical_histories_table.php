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
        Schema::create('patient_medical_histories', function (Blueprint $table) {
            $table->id();
            $table->text('allergies')->nullable();
            $table->text('medication')->nullable();
            $table->text('illness')->nullable();
            $table->text('admission')->nullable();
            $table->text('immunisation')->nullable();
            $table->foreignId('patient_visit_id')->constrained();
            $table->softDeletes();
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
        Schema::dropIfExists('patient_medical_histories');
    }
};
