<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRjoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rjo', function (Blueprint $table) {
            $table->id()->from(10000);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('marketing_id');
            $table->string('unit_code');
            $table->string('part_name');
            $table->text('problem');
            $table->text('job_desc');
            $table->date('date_received');
            $table->date('date_request');
            
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('marketing_id')->references('id')->on('marketing')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('rjo');
    }
}
