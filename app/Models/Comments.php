<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = ['message']; //this servers a whitelist and can be mass assigned

    public static function boot(){
        parent::boot();

        self::creating(function($model){
            return $model->user_id = auth()->user()->id;
        });
    }

    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function author(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function subcomments()
    {
        return $this->hasMany(SubComments::class);
    }
}
