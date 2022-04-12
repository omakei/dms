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
        Schema::create('patient_gynaecological_histories', function (Blueprint $table) {
            $table->id();
            $table->string('menarche')->nullable();
            $table->string('menopause')->nullable();
            $table->string('menstrual_cycles')->nullable();
            $table->string('frequency_of_changing_pads')->nullable();
            $table->string('recurrent_menstruation')->nullable();
            $table->string('contraceptive')->nullable();
            $table->string('pregnancy')->nullable();
            $table->string('lnmp')->nullable();
            $table->string('gravidity')->nullable();
            $table->string('parity')->nullable();
            $table->string('children')->nullable();
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
        Schema::dropIfExists('patient_gynaecological_histories');
    }
};
