<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackLikes extends Model
{
    use HasFactory;

    protected $table = 'track_likes';
    public $timestamps = false;

    protected $fillable = [
        'type'
    ];

    public static function boot(){
        parent::boot();

        self::creating(function($model){
            return $model->user_id = auth()->user()->id;
        });
    }

}
