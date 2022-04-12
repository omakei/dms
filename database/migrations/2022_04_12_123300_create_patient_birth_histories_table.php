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
        Schema::create('patient_birth_histories', function (Blueprint $table) {
            $table->id();
            $table->text('antenatal')->nullable();
            $table->text('natal')->nullable();
            $table->text('postnatal')->nullable();
            $table->text('nutrition')->nullable();
            $table->text('growth')->nullable();
            $table->text('development')->nullable();
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
        Schema::dropIfExists('patient_birth_histories');
    }
};
