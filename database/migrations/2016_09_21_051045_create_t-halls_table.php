<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t__halls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theatre_id')->unsigned();
            $table->string('name');
            $table->text('json');
            $table->timestamps();

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
        Schema::dropIfExists('t__halls');
    }
}
