<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     protected $guarded = [
         "id"
       ];
     //protected $with = ["posts", "comments"];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    
    protected $casts = [
      'hobbies' => 'array',
      'social_media' => 'array',
      'request_friendship' => 'array',
      'education' => 'object',
      'relationship' => 'object',
      'workspace' => 'object',
    ];
    /**
     * friendship
     *
     * showing all friends @Array
     * show : $user->friends || $user->friends()->get()
     * add friends with id (@param Array)
     * add : $user->friends()->attach([user.id])
     * 
     * remove friends with id (@param Array)
     * remove : $user->friends()->detach([user.id]
     * )
     * remove all friends then add friends with id (@param Array)
     * sync : $user->friends()->sync([user.id])
     */
     public function friends() {
      return $this->belongsToMany(User::class, 'friend_user', 'user_id', 'friend_id');
     }
     public function posts(){
      return $this->hasMany(Post::class);
    }
     public function comments(){
      return $this->hasMany(Comment::class);
    }
    
}
