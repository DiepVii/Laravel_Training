<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->increments('equipment_id');
            $table->string('name');
            $table->integer('status');
            $table->text('description');
            $table->string('image');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('type_id')->on('type')
                ->onDelete('cascade')->onUpdate('cascade');
            // $table->bigInteger('user_id')->unsigned()->nullable();
            // $table->foreign('user_id')->references('id')->on('users')
            //     ->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('equipment');
    }
};
