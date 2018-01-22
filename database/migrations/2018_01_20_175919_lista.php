<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lista extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista', function (Blueprint $table) {
            $table->increments('id_lista');
            $table->string('tarefa',255);
            $table->date('data_limite');
            $table->boolean('estado_tarefa');
            $table->integer('id_projeto')->unsigned();
            $table->foreign('id_projeto')->references('id_projeto')->on('projeto')->onDelete('cascade');
            $table->integer('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
