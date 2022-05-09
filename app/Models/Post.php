<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'post_title',
        'body',
        'file_name'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lcount(){
        return $this->hasOne(Likes::class, 'post_id');
    }

    public function comments(){
        // return $this->hasMany(Comments::class, 'post_id')->orderBy('created_at', 'desc');
        return $this->hasMany(Comments::class, 'post_id');
    }

}
