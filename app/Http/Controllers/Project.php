<?php

namespace App\Http\Controllers;
use App\Models\WordReportMaker;
use App\Models\TempTabInput;
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

        

    public function fetch_child_report_template(Request $request)
        {
            $reportTypeInput = $request->input('report_type');
            $reportType = ($reportTypeInput == 3) ? 2 : 1;

            $templates = WordReportMaker::where('status', 1)
                            ->where('type', 2)
                            ->where('from_tally', 1)
                            ->where('report_type', $reportType)
                            ->get();

            if ($templates->count() > 0) {
                $reportArr = $templates->map(function ($item) {
                    return $item->id . '-' . $item->name;
                });

                return response()->json([
                    'status' => 200,
                    'child_data' => $reportArr,
                    'body' => 'data found'
                ]);
            } else {
                return response()->json([
                    'status' => 201,
                    'body' => 'No data found'
                ]);
            }
        }


    
    public function getPageDataToEditor_planning(Request $request)
        {
            $request->validate([
                'id' => 'required',
                'type' => 'required',
                'page_id' => 'required'
            ]);

            $id = $request->input('id');
            $type = $request->input('type');
            $page_id = $request->input('page_id');

            $data = [];
            $getTempTables = [];

            // Get main report data
            if ($type == 2) {
                $report = WordReportMaker::where([
                    'id' => $id,
                    'type' => 2,
                    'from_tally' => 1
                ])->first();
            } else {
                $report = null; 
            }

            // Get temp tables related to this template
            $tempTables = TempTabInput::where('temp_id', $id)
                ->where('status', 1)
                ->get();

            foreach ($tempTables as $val) {
                $getTempTables[] = [
                    'table_id' => $val->id,
                    'name' => $val->name,
                    'table_json' => $val->json
                ];
            }

            if ($report) {
                $code = json_decode($report->code);

                if (!is_null($code) && isset($code[0]->pages)) {
                    foreach ($code[0]->pages as $page) {
                        if (isset($page->page_id) && $page->page_id == $page_id) {
                            $data = $page;
                            break;
                        }
                    }
                }

                return response()->json([
                    'status' => 200,
                    'body' => $data,
                    'id' => $id,
                    'bmr_object' => $report->code,
                    'report_name' => $report->name,
                    'report_type' => $report->report_type,
                    'temp_table_data' => $getTempTables
                ]);
            } else {
                return response()->json([
                    'status' => 201,
                    'body' => 'No data found'
                ]);
            }
        }  
        
        
    public function planningBmrReportView($type, $id)
    {
        return view('planning.view_planning_bmr_report', [
            'title' => 'Report List',
            'report_id' => $id,
            'type' => $type,
        ]);
    }

}