<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;

    protected $table = 'account';          // table name
    protected $primaryKey = 'user_id';     // primary key ikut SDD

    protected $fillable = [
        'email',
        'password',
        'fullname',
        'role'
    ];

    protected $hidden = [
        'password'
    ];
}
