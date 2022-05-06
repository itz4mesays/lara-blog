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

    public static function boot(){
        parent::boot();

        // self::creating(function($model){
        //     // ... code here
        // });

        // self::creating(fn($model) => $model->user_id == auth()->user()->id);
    }

    public function save(array $options = array())
    {
        $this->user_id = auth()->user()->id;
        parent::save($options);
    }

}
