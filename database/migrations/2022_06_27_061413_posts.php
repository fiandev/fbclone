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
        Schema::create('posts', function (Blueprint $table) {
          $table->id();
          $table->foreignId("user_id");
          //$table->foreignId("comment_id");
          $table->text("slug")->unique();
          $table->text("content");
          $table->string("mediaType")->nullable();
          $table->text("media")->nullable();
          $table->integer("views")->default(0);
          $table->timestamp("published_at");
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
        Schema::dropIfExists('posts');
    }
};