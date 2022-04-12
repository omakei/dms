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
        Schema::create('patient_social_histories', function (Blueprint $table) {
            $table->id();
            $table->text('chronic_illness_in_the_family')->nullable();
            $table->text('substance_abuse')->nullable();
            $table->text('adoption')->nullable();
            $table->text('other')->nullable();
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
        Schema::dropIfExists('patient_social_histories');
    }
};
