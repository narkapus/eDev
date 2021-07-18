<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDocuments extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'eCode',
        'eName',
        'createDate',
        'update_Date',
        'createUser',

    ];

    protected $casts = [
        'createDate' => 'datetime',
        'update_Date' => 'datetime',
    ];
}
