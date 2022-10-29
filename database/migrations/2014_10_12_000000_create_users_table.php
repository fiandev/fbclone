<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('uid');
            $table->string('name');
            $table->string('email')->unique();
            $table->text('password');
            $table->json("request_friendship")->default("[]");
            /* user info */
            $table->text("bio")->nullable();
            $table->text("photo-profile")->nullable();
            $table->text("cover-profile")->nullable();
            $table->text("hometown")->nullable();
            $table->text("locate")->nullable();
            $table->text("workspace")->nullable();
            $table->json("education")->nullable();
            $table->text("gender")->nullable();
            $table->json("relationship")->nullable();
            $table->text("website")->nullable();
            $table->json("social_media")->nullable();
            $table->json("hobbies")->nullable();
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
        Schema::dropIfExists('users');
    }
}
