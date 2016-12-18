<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUPermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u__perms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

//            $table->timestamps();
        });

        Schema::create('user__perms', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('perm_id')->unsigned();

            $table->primary(['user_id', 'perm_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('perm_id')
                ->references('id')
                ->on('u__perms')
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
        Schema::dropIfExists('user__perms');
        Schema::dropIfExists('u__perms');
    }
}
