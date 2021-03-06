<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('tasks', function (Blueprint $table) {
        $table->foreign('user_id', 'user')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
        $table->foreign('completed_by_id', 'creator')
              ->references('id')
              ->on('users')
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
      Schema::table('tasks', function (Blueprint $table) {

        $table->dropForeign('user');
        $table->dropForeign('creator');
      });
    }
}
