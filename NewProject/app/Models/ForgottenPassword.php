<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgottenPassword extends Model
{
    protected $table = 'forgotten_passwords';
    use HasFactory;
    protected $fillable = [
        'code',
        'userID',
        'url'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
