<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerInfo extends Model
{
    protected $table = 'partnerinfos';

    protected $fillable = [
        'portal_id',
        'partner_name',
        'engagement_lead',
        'partner_status'
    ];
}
