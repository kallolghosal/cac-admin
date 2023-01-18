<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerType extends Model
{
    protected $table = 'partner_types';

    protected $fillable = [
        'partner_id',
        'due_diligence',
        'stakeholder_type',
        'partner_type',
        'org_type',
        'category_type',
        'vp_category',
        'primary_theme',
        'secondary_theme','
        founding_year'
    ];

    protected $guarded = [];

}
