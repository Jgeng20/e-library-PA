<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    protected $table = 'users';
    
    protected $fillable = [
        'name',
        'email',
        'profile_foto',
        'address',
        'phone',
        'member_type',
        'password',
    ];
}
