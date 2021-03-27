<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekerjaanSelesaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekerjaan_selesai', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ccr_id')->unique();
            $table->unsignedInteger('ppc_id');
            $table->date('date_finish');

            $table->foreign('ccr_id')->references('id')->on('ccr')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ppc_id')->references('id')->on('ppc')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pekerjaan_selesai');
    }
}
