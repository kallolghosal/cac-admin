<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOps extends Model
{
    protected $table = 'check_ops';
    protected $fillable = [
        'check_ops',
        'check_val'
    ];
}
