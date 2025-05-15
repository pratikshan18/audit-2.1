<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditUser extends Model
{
    use HasFactory;
    protected $table = 'audit_users';

}
