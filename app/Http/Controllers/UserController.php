<?php

namespace App\Http\Controllers;
use App\Models\AuditUser;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
  public function audit_all_users()
    {
        $all_users = AuditUser::whereNotIn('user_type', [1, 2])->get();
        return response()->json($all_users);
    }


}
