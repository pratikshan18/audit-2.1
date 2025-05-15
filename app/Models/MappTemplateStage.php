<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MappTemplateStage extends Model
{
    protected $table = 'mapp_template_stages';
    protected $fillable = [
        'template_id', 'stage_name', 'created_by', 'firm_id', 'process_id', 'status'
    ];
    public $timestamps = true; 
}
