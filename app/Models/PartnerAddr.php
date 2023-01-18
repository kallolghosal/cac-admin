<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerAddr extends Model
{
    protected $table = 'partner_addrs';

    protected $fillable = [
        'partner_id',
        'addr',
        'district',
        'state',
        'poc_name',
        'poc_designation',
        'mobile',
        'email',
        'alt_poc_name',
        'alt_poc_email',
        'alt_poc_mobile',
        'website',
        'partner_bio'
    ];
}
