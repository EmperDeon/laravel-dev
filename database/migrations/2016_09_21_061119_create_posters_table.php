<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('t_perf_id')->unsigned();
            $table->integer('hall_id')->unsigned();


            $table->timestamps();
            $table->timestamp('date')->nullable();

            $table->foreign('t_perf_id')
                ->references('id')
                ->on('t__performances')
                ->onDelete('cascade');

            $table->foreign('hall_id')
                ->references('id')
                ->on('t__halls')
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
        Schema::dropIfExists('posters');
    }
}
