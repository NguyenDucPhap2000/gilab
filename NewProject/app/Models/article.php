<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    protected $table = 'articles';
    use HasFactory;
    protected $fillable = [
        'UserName',
        'title',
        'userID',
        'content',
        'image',
        'displayed'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
