<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempMasterChildMapping extends Model
{
    protected $table = 'temp_master_child_mapping';

    protected $fillable = [
        'master_temp_id',
        'child_process_temp_id',
        'dependant_temp_id',
        'status',
        'created_by'
    ];

    public $timestamps = false;
}
