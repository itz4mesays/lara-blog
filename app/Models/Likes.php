<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'likes',
        'unlikes',
        'sub_comment_id'
    ];

    public static function boot(){
        parent::boot();

        self::creating(function($model){
            return $model->user_id = auth()->user()->id;
        });

    }

    public function post(){
        return $this->belongsTo(User::class);
    }
}
