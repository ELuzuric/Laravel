<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->timestamps();
            $table->integer('id_image')->unsigned();
            $table->foreign('id_image')
                  ->references('id_image')
                  ->on('image_comments')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('comments', function(Blueprint $table) {
        //     $table->dropForeign('image_comments_comments_id_foreign');
        // });
        Schema::drop('comments');
    }
}
