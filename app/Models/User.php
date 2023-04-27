<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'role', 'phone', 'nickname', 'email', 'firstname', 'lastname',
        'patronymic', 'address', 'image', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function isAdmin() {
        if($this->role === 2) return true;
        return false;
    }
}
