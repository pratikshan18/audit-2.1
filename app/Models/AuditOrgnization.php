<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditOrgnization extends Model
{
    use HasFactory;
    protected $table = 'audit_orgnizations';

    protected $fillable = [
        'company_name',
        'short_name',
        'address',
        'com_reg_detail',
        'company_logo',
        // 'status',
        // 'firm_id',
        // 'cab_id',
        // 'profile_access'
    ];
}
