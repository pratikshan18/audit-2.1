<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempTabInput extends Model
{
    protected $table = 'tbl_temp_tab_input';
    protected $fillable = ['temp_id', 'name', 'json', 'status'];
}
