<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'eCode',
        'eName',
        'eFile',
        'userId',
        'createDate',
    ];

    protected $casts = [
        'createDate' => 'datetime',
    ];
}
