<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoshootSession extends Model
{
    use HasFactory;

    protected $table = 'photoshoot_sessions';
    protected $primaryKey = 'session_id';

    protected $fillable = [
        'session_date',
        'start_time',
        'end_time',
        'status'
    ];
}
