<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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
    public function hasRole($role)
    {
        return $this->role === $role;
    }
}
