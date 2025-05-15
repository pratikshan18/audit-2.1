<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class WordReportMaker extends Model
{
    
    protected $table = 'word_reportmaker_table';

    protected $fillable = [
        'name',
        'status',
        'is_dashboard',
        'report_type',
        'type',
        'from_tally',
        'company_id',
    ];
  
    public static function getPlanningReports($user)
        {
            
            if ($user->user_type == 1) {
                $tables = self::select('id', 'name', 'status', 'is_dashboard', 'report_type', 'template_type')
                    ->where([
                        ['type', '=', 2],
                        ['from_tally', '=', 1],
                        ['report_type', '=', 1],
                        ['status', '=', 1],
                    ])
                    ->get();
                    //   dd($tables->toSql());
            } else {
                $tables = self::select('id', 'name', 'status', 'is_dashboard', 'report_type', 'template_type')
                    ->where([
                        ['company_id', '=', $user->firm_id],
                        ['type', '=', 2],
                        ['from_tally', '=', 1],
                        ['report_type', '=', 1],
                    ])
                    ->get();
            }
            // dd($tables->toSql());
            $tableRows = [];
            $i = 1;
            foreach ($tables as $row) {
                $tableRows[] = [
                    $i++,
                    $row->name,
                    $row->id,
                    $row->status,
                    $row->is_dashboard,
                    $row->report_type,
                    $row->template_type,
                ];
            }

            rsort($tableRows); 

            return $tableRows;
        }

        public static function getMasterWordReports($userType, $companyId)
        {
            $query = self::select('id', 'name', 'status', 'is_dashboard', 'report_type')
                ->where('type', 2)
                ->where('from_tally', 1)
                ->where('report_type', 3);

            if ($userType != 1) {
                $query->where('company_id', $companyId);
            }

            return $query->get();
        }
    }
