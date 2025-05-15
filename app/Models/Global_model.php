<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Global_model extends Model
{
    public function enquiry_employee($user_id)
    {
      if (!$userId) {
        return false;
        }

        $count = DB::table('enquiry_header_all')
            ->where('allot_to', $userId)
            ->where('status', 1)
            ->count();

        return $count > 0 ? $count : false;
    }


    public function enquiryCa($firmId)
    {
        if (!$firmId) {
            return false;
        }

        $count = DB::table('enquiry_header_all')
            ->where('firm_id', $firmId)
            ->whereIn('status', [0, 2])
            ->count();

        return $count > 0 ? $count : false;
    }


    public function enquiry_web_enquiry()
    {
        $count = DB::table('web_customer_service')
            ->where('status', 0)
            ->count();

        return $count > 0 ? $count : false;
    }

}
