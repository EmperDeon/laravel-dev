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

        Schema::create('perfs__actors', function (Blueprint $table) {
            $table->integer('t__perf_id')->unsigned();
            $table->integer('actor_id')->unsigned();

            $table->foreign('t__perf_id')->references('id')->on('t__performances')->onDelete('cascade');
            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfs__actors');
        Schema::dropIfExists('t__performances');
    }
}
