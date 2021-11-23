<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;
    protected $primaryKey = 'mb_no';

    protected $fillable = [
        'mb_no',
        'mb_name',
    ];

    protected $casts = [
        'mb_no' => 'string',
    ];
}
