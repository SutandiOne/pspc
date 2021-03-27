<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSparePartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spare_part', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('marketing_id');
            $table->unsignedBigInteger('ppc_id');
            $table->integer('unit_code');
            $table->string('part_name');
            $table->string('problem');
            $table->string('job_desc');
            $table->string('ccr_file');
            $table->date('date_received');
            $table->date('date_request');
            $table->date('date_finish');
            $table->timestamps();

            $table->foreign('ppc_id')->references('id')->on('ppc')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('customer')->onUpdate('cascade');
            $table->foreign('marketing_id')->references('id')->on('marketing')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spare_part');
    }
}
