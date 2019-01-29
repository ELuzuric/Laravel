<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_comments', function (Blueprint $table) {
            $table->increments('id_image');
            $table->timestamps();
            $table->string('URLimage');
            $table->integer('activity_id')->unsigned();
            $table->foreign('activity_id')
                  ->references('id')
                  ->on('activities')
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
        Schema::table('image_comments', function(Blueprint $table) {
            $table->dropForeign('image_comments_activity_id_foreign');
        });
        Schema::drop('image_comments');
    }
}
