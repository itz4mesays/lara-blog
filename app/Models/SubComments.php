<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubComments extends Model
{
    use HasFactory;

    protected $fillable = ['message'];

    public function comments(){
        return $this->belongsTo(Comments::class, 'parent_comment_id');
    }
}
