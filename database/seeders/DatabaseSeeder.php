<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Response;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Post::factory(30)->create();
        User::create([
          "uid" => make_uid(16),
          "name" => "fian",
          "email" => "akbaraditia15@gmail.com",
          "password" => bcrypt("password"),
          "request_friendship" => [2, 3, 4],
          "bio" => "just someone who wants make dreams come true",
          "hobbies" => ["ngoding", "learn", "anime"],
          "locate" => "lamongan",
          "hometown" => "surabaya",
          "gender" => "male",
          "education" => [
              "major" => "teknik komputer dan jaringan",
              "place" => "smk Abdurrahman Wahid"
            ],
          "social_media" => [
              "instagram" => "fianskuy",
              "github" => "fiandev",
            ],
          "relationship" => [
              "status" => "married",
              "couple" => "unknown",
            ],
          "workspace" => [
              "position" => "CEO",
              "company" => "Meta",
            ],
          ]);
        User::create([
          "uid" => make_uid(16),
          "name" => "fian2",
          "email" => "wongkeras2@gmail.com",
          "password" => bcrypt("password")
          ]);
        Comment::factory(30)->create();
        User::factory(30)->create();
        Response::factory(30)->create();
    }
}
