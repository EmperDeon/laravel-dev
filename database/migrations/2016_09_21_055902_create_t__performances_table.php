<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t__performances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theatre_id')->unsigned();
            $table->integer('perf_id')->unsigned();

            $table->text('desc');
            $table->string('desc_s');
            $table->string('img');

            $table->timestamps();

            $table->foreign('perf_id')
                ->references('id')
                ->on('performances')
                ->onDelete('cascade');

            $table->foreign('theatre_id')
                ->references('id')
                ->on('theatres')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t__performances');
    }
}
