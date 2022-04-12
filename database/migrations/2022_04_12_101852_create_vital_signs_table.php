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
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id();
            $table->integer('temperature');
            $table->integer('height')->nullable();
            $table->integer('weight');
            $table->integer('systolic_pressure');
            $table->integer('diastolic_pressure');
            $table->integer('respiratory_rate')->nullable();
            $table->integer('oxygen_saturation')->nullable();
            $table->integer('pulse_rate')->nullable();
            $table->double('bmi')->nullable();
            $table->foreignId('patient_id')->constrained();
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
        Schema::dropIfExists('vital_signs');
    }
};
