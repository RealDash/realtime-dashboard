<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('music_title');
            $table->string('file_name', 100)->unique();
            $table->string('format')->nullable();
            $table->string('duration')->nullable();
            $table->integer('artist_id')->unsigned()->index();
            $table->date('release_date')->nullable();
            $table->boolean('published')->default(true);
            $table->float('size',15,7)->nullable();
            $table->integer('frequency')->unsigned()->default(0);
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('artist_id')->references('id')
                  ->on('artists')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('musics');
    }
}
