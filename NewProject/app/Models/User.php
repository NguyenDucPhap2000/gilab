<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    protected $table = 'users';
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'name',
        'dateofbirth',
        'account',
        'password',
        'email'
    ];

    public function verify_users()
    {
        return $this->hasOne('App\Models\VerifyUser');
    }
    public function getPass()
    {
        return $this->hasOne('App\Models\ForgottenPassword');
    }
}
