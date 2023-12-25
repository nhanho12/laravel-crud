<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{   
    protected $table = 'users';
    protected $fillable = [
        'fullname', 'username', 'password', 'email', 'phone-number', 'address', 'role'
    ];
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $enumCasts = [
        'role' => [
            'ADMIN' => 'admin',
            'USER' => 'user',
        ],
    ];
}
