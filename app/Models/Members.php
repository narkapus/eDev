<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;
    protected $primaryKey = 'mb_id';

    protected $fillable = [
        'mb_id',
        'mb_name',
    ];
}
