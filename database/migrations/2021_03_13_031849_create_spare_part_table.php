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
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('marketing_id');
            $table->unsignedInteger('ppc_id');
            $table->integer('unit_code');
            $table->string('part_name');
            $table->string('problem');
            $table->string('job_desc');
            $table->string('ccr_file');
            $table->date('date_received');
            $table->date('date_request');
            $table->date('date_finish');
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
        Schema::dropIfExists('spare_part');
    }
}
