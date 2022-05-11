<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubComments extends Model
{
    use HasFactory;

    protected $table = 'subcomments';

    protected $fillable = ['message'];

    public static function boot(){
        parent::boot();

        self::creating(function($model){
            return $model->user_id = auth()->user()->id;
        });
    }

    public function author(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function comments(){
        return $this->belongsTo(Comments::class, 'parent_comment_id');
    }
}
