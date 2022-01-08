<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('color', 7);
            $table->integer('like');
            $table->string('bio', 240);
            $table->string('identificationToken');
            $table->string('profilePicPath');
            // TODO
            // we need to save images, i think we need an image path and maybe a name
            // https://www.tutsmake.com/laravel-8-image-upload-tutorial/
            //
            // php artisan migrate
            // php artisan migrate:rollback
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['color', 'profilePicPath', 'like', 'bio', 'identificationToken']);
        });
    }
}
