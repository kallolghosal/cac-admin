<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerMaster extends Model
{
    protected $table = 'partner_master';
    protected $fillable = [
        'portal_id', 
        'partner_name', 
        'engagement_lead', 
        'status', 
        'due_diligence', 
        'stakeholder_type', 
        'partner_type', 
        'organization_type', 
        'category_type', 
        'vp_category', 
        'primary_theme', 
        'secondary_theme', 
        'founding_year', 
        'state`, `district', 
        'registered_office', 
        'communication_address', 
        'poc_name', 
        'poc_designation', 
        'alt_poc', 
        'mobile', 
        'email', 
        'alt_poc_name', 
        'alt_poc_phone', 
        'alt_poc_designation', 
        'alt_poc_email', 
        'website', 
        'partner_bio', 
        'node_type', 
        'node_status', 
        'hear_about_us', 
        'referrals'
    ];
}
