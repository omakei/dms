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
        Schema::create('patient_complaint_histories', function (Blueprint $table) {
            $table->id();
            $table->text('chief_complaint');
            $table->text('other_complaint')->nullable();
            $table->text('history_of_presenting_illness');
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
        Schema::dropIfExists('patient_complaint_histories');
    }
};
