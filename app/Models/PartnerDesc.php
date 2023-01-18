<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerDesc extends Model
{
    protected $table = 'partner_desc';

    protected $fillable = [
        'partner_id',
        'node_type',
        'node_status',
        'reach_per_year',
        'hear_about_us',
        'referrals',
        'mou_charter'
    ];
}
