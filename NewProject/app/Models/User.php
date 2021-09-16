<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    use HasFactory;
    protected $fillable = [
        'name',
        'dateofbirth',
        'account',
        'password',
        'email'
    ];
    
    public function verify_users(){
        return $this->hasOne('App\Models\VerifyUser');
    }
    public function getPass(){
        return $this->hasOne('App\Models\ForgottenPassword');
    }
}
