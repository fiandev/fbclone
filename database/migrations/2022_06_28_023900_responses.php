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
        Schema::create('responses', function (Blueprint $table) {
          $table->id();
          $table->foreignId("post_id");
          $table->foreignId("user_id");
          $table->boolean("like")->default(false);
          $table->boolean("laught")->default(false);
          $table->boolean("sad")->default(false);
          $table->boolean("wow")->default(false);
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
        Schema::dropIfExists('responses');
    }
};
