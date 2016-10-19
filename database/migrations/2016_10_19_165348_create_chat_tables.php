<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('visitor_name');
            $table->string('visitor_email');
            $table->integer('representative_id')->unsigned();
            $table->foreign('representative_id')->references('id')->on('users');
            $table->timestamps();
        });
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('isFromRep');
            $table->string('payload');
            $table->integer('chat_id')->unsigned();
            $table->foreign('chat_id')->references('id')->on('chat');
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
        Schema::drop('messages');
        Schema::drop('chats');
    }
}
