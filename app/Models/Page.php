<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'facebook_page_id', 'facebook_page_name', 'facebook_page_access_token', 'user_id'
    ];


    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Posts()
    {
        return $this->hasMany(Post::class);
    }
}
