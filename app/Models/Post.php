<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'post', 'type', 'file_path','date','user_id','page_id'
    ];

    public function Page()
    {
        return $this->belongsTo(Page::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
