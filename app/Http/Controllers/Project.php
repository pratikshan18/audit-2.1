<?php

namespace App\Http\Controllers;
use App\Models\WordReportMaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Project extends Controller
{
    public function getWordReportPlanning()
        {
            $user = Auth::user();
            // $user = 1;
            $data = WordReportMaker::getPlanningReports($user);

            return response()->json([
                'draw' => 1,
                'recordsTotal' => count($data),
                'recordsFiltered' => count($data),
                'data' => $data,
            ]);
        }


    public function getMasterWordReportPlanning(Request $request)
        {
        
            $userSession = session()->get('user_session');

            $userType = $userSession['user_type'] ?? null;
            $companyId = $userSession['firm_id'] ?? null;

            // Fetch data from model
            $reports = WordReportMaker::getMasterWordReports($userType, $companyId);

            // Format for DataTables
            $tableRows = [];
            $i = 1;

            foreach ($reports as $report) {
                $tableRows[] = [
                    $i,
                    $report->name,
                    $report->id,
                    $report->status,
                    $report->is_dashboard,
                    $report->report_type,
                ];
                $i++;
            }

            rsort($tableRows); 

            return response()->json([
                "draw" => 1,
                "recordsTotal" => count($tableRows),
                "recordsFiltered" => count($tableRows),
                "data" => $tableRows,
            ]);
        }    


    public function getBMRListPlanning(Request $request)
        {
            $company_id = session('user_session.firm_id'); 

            $option = "<option value='-1'>Select Copy Template</option>";

            $records = DB::table('word_reportMaker_table')
                ->select('id', 'name')
                ->where([
                    ['status', '=', 1],
                    ['company_id', '=', $company_id],
                    ['type', '=', 2],
                    ['from_tally', '=', 1],
                    ['report_type', '=', 1],
                ])
                ->orderByDesc('id')
                ->get();

            if (!$records->isEmpty()) {
                foreach ($records as $row) {
                    $option .= "<option value='{$row->id}'>{$row->name}</option>";
                }

                $response = [
                    'status' => 200,
                    'body' => 'Data Found',
                    'data' => $option,
                ];
            } else {
                $response = [
                    'status' => 201,
                    'body' => 'No Data Found',
                    'data' => "<option>No Data Found</option>",
                ];
            }

            return response()->json($response);
        }   
        
        
    public function changeStatusPlanning(Request $request)
        {
            $request->validate([
                'id' => 'required|integer',
                'status' => 'required|in:0,1'
            ]);

            $id = $request->input('id');
            $status = $request->input('status') == 1 ? 0 : 1;

            $record = WordReportMaker::where([
                'id' => $id,
                'type' => 2,
                'from_tally' => 1
            ])->first();

            if ($record) {
                $record->status = $status;
                $record->save();

                return response()->json([
                    'status' => 200,
                    'body' => 'Status Change Successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 201,
                    'body' => 'No Data Found'
                ]);
            }    
        }
}