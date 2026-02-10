<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photos';
    protected $primaryKey = 'photo_id';

    protected $fillable = [
        'reservation_id',
        'file_name',
        'file_path'
    ];
}
