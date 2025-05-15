<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordReportMaker;
use App\Models\MappTemplateStage;
use Illuminate\Support\Facades\DB;

class ProcessTemplateController extends Controller
{
    public function add_template_stages(Request $request)
    {
        $request->validate([
            'bmr_name' => 'required|string',
        ]);

        $user = auth()->user();
        $name = $request->input('bmr_name');
        $id = $request->input('bmr_update_id');
        $company_id = $user->firm_id;
        $bmr_list = $request->input('bmr_list');
        $is_dashboard = $request->input('is_dashboard');
        $report_type = $request->input('report_type');
        $template_type = $request->input('templateTypeRadio');

        DB::beginTransaction();
        try {
            if ($id) {
                // Update
                $template = WordReportMaker::where([
                    'id' => $id,
                    'type' => 2,
                    'from_tally' => 1
                ])->first();

                if ($template) {
                    $template->update([
                        'name' => $name,
                        'created_by' => $user->id,
                        'is_dashboard' => $is_dashboard,
                        'report_type' => $report_type,
                        'template_type' => $template_type,
                    ]);
                }

                $template_id = $id;
            } else {
                // Check for duplicate
                if (WordReportMaker::where('name', $name)->exists()) {
                    return response()->json([
                        'status' => 201,
                        'body' => 'Same name template already exist'
                    ]);
                }

                $data = [
                    'name' => $name,
                    'created_by' => $user->id,
                    'company_id' => $company_id,
                    'is_dashboard' => $is_dashboard,
                    'from_tally' => 1,
                    'type' => 2,
                    'report_type' => $report_type,
                    'template_type' => $template_type,
                ];

                if ($bmr_list != -1) {
                    $existing = WordReportMaker::find($bmr_list);
                    if ($existing) {
                        $data['code'] = $existing->code;
                    }
                }

                $template = WordReportMaker::create($data);
                $template_id = $template->id;
            }

            // Handle template stages
            if ($request->has('stage_name')) {
                $stage_names = $request->input('stage_name');
                $mapp_data = [];

                foreach ($stage_names as $stage_name) {
                    if (!is_null($stage_name) && $stage_name != '') {
                        $mapp_data[] = [
                            'template_id' => $template_id,
                            'stage_name' => $stage_name,
                            'created_by' => $user->id,
                            'firm_id' => $company_id,
                            'process_id' => $template_id,
                            'status' => 1,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }

                // Delete old stages
                MappTemplateStage::where('template_id', $template_id)
                    ->where('status', 1)
                    ->where('firm_id', $company_id)
                    ->delete();

                // Insert new stages
                if (!empty($mapp_data)) {
                    MappTemplateStage::insert($mapp_data);
                }
            }

            DB::commit();
            return response()->json([
                'status' => 200,
                'body' => 'Saved Successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 201,
                'body' => 'Something Went Wrong',
                'error' => $e->getMessage()
            ]);
        }
    }
    
}
