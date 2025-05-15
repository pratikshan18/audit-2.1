<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class AuditUsers extends Model
{
    // use HasFactory;
   
    //----Insert Admin--
    public static function insert_admin($data)
    {
        DB::beginTransaction();

        try {
            $password = rand(100, 999);
            $user_id = 'user_'.rand(100, 999);
            $admin = DB::table('audit_user_header_all')->insert([
                'user_name' => $data['name'],
                'user_id' =>$user_id,
                'user_type' => 2,
                'email' => $data['email'],
                'password' => $password,
                'cab_id' => $data['company_id'],
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::commit();
            return true;

        } catch (\Exception $e) {
            // Rollback if anything fails
            DB::rollback();

            return false;
        }
    }
   
    //----Get Admin DAta--
    public static function fetch_admin_user_data($id)
    {
        $admin = DB::table('audit_user_header_all')
            ->where('id', $id)
            ->where('status', 1)
            ->where('user_type', 2)
            ->first();

        if ($admin) {
            return [
                'status' => true,
                'data' => $admin,
            ];
        } else {
            return [
                'status' => false,
                'message' => 'User not found.',
            ];
        }
    }
   
    //----Update Admin DAta--
    public static function updateAdminUser($id,$data)
    {
        try {
            DB::table('audit_user_header_all')
                ->where('id', $id)
                ->update([
                    'user_name'   => $data['name'],
                    'email'       => $data['email'],
                    'cab_id'      => $data['company_id'],
                    'updated_at'  => now(),
                ]);

            return true;

        } catch (\Exception $e) {
            return false;
        }
    }

    //----Delete Admin--
    public static function deleteAdminUser($id)
    {
         $user = DB::table('audit_user_header_all')
              ->where('id', $id)
              ->where('status', 1)
              ->first();

        if (!$user) {
            return false; 
        }
        
        try {
            DB::table('audit_user_header_all')->where('id', $id)->delete();
            return true;

        } catch (\Exception $e) {
            return false;
        }
    }
}
