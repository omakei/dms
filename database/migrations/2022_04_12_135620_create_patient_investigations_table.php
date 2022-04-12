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
        Schema::create('patient_investigations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratory_test_id')->constrained();
            $table->foreignId('patient_visit_id')->constrained();
            $table->string('state')->default('Pending');
            $table->text('state_description')->nullable();
            $table->text('results')->nullable();
            $table->integer('status')->default(0);
            $table->integer('result_is_published')->default(0);
            $table->foreignId('result_publisher')->nullable()->constrained('users', 'id');
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
        Schema::dropIfExists('patient_investigations');
    }
};
