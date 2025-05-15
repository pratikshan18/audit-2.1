<?php

namespace App\Http\Controllers;
use App\Models\Global_model;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function getNumEnquiry(Request $request)
    {
        // Getting session data
        $userSession = session()->get('user_session');
        $userId = $userSession['user_id'] ?? null;
        $firmId = $userSession['firm_id'] ?? null;

        // Get enquiries from model methods
        $employeeCount = Global_model::enquiry_employee($userId);
        $firmCount = Global_model::enquiryCa($firmId);

        if ($employeeCount !== false || $firmCount !== false) {
            return response()->json([
                'status' => true,
                'result' => $employeeCount,
                'result_ca' => $employeeCount + $firmCount,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'result' => 0,
                'result_ca' => 0,
            ]);
        }
    }


    public function get_num_Webenquiry(Request $request) {
        $userSession = session()->get('user_session');
        $userId = $userSession['user_id'] ?? null;
        $count = Global_model::enquiry_web_enquiry($userId);
        return response()->json([
                'status' => $count !== false,
                'result' => $count ?: 0,
            ]);

    }
}
