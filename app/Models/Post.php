<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    //protected $with = ["author", "comments"];
    
    public function comments(){
      return $this->hasMany(Comment::class);
    }
    public function author(){
      return $this->belongsTo(User::class, "user_id");
    }
    public function responses(){
      return $this->hasMany(Response::class);
    }
}
