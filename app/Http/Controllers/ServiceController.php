<?php

namespace App\Http\Controllers;
use App\Models\MappTemplateStage;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function getTemplateMapChildProcess(Request $request)
    {
        $request->validate([
            'child_temp_id' => 'required'
        ]);

        $user = auth()->user(); 
        $firm_id = $user->firm_id;
        $temp_id = $request->input('child_temp_id');

        $stageData = MappTemplateStage::where('template_id', $temp_id)
                        ->where('status', 1)
                        ->where('firm_id', $firm_id)
                        ->get();

        if ($stageData->count() > 0) {
            return response()->json([
                'status' => 200,
                'multi_stageData' => $stageData
            ]);
        } else {
            return response()->json([
                'status' => 201,
                'body' => 'No data Found'
            ]);
        }
    }
}
