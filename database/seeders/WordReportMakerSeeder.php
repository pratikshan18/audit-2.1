<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordReportMakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('word_reportMaker_table')->insert([
            [
                'id' => 1,
                'name' => 'Paracetamol BMR Reports1',
                'code' => '[{"bmr_no":"10","production_id":"10","pages":[{"page_name":"Paracetamol BMR Reports1","page_type":"","html_code":"<p align=\"center\" style=\"text-align:center\"><b><u><span style=\"font-size:10.0pt;font-family:&quot;Verdana&quot;,&quot;sans-serif&quot..."}]}]',
                'created_by' => '87',
                'created_on' => '2022-09-06 15:03:42',
                'template_id' => 1,
                'type' => 1,
                'status' => 1,
                'company_id' => 'Firm_26467',
                'is_dashboard' => 0,
                'from_tally' => 1,
                'tally_company_id' => null,
                'tally_branch_id' => null,
                'exchange_rate' => null,
                'report_type' => 1,
                'template_type' => 1,
                'template_check_permission' => 1,
                'create_link' => 0,
            ],
            [
                'id' => 5,
                'name' => 'core - creator (Vikhroli)',
                'code' => '[{"bmr_no":"10","production_id":"10","pages":[{"page_name":"core - creator (Vikhroli)","page_type":"","html_code":"<p>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<meta name=\"ProgId\" content=\"Word.DocumentW\" />..."}]}]',
                'created_by' => '202',
                'created_on' => '2023-01-12 11:48:25',
                'template_id' => 1,
                'type' => 1,
                'status' => 1,
                'company_id' => 'Firm_26467',
                'is_dashboard' => 0,
                'from_tally' => 2,
                'tally_company_id' => 7,
                'tally_branch_id' => 3,
                'exchange_rate' => null,
                'report_type' => 1,
                'template_type' => 1,
                'template_check_permission' => 1,
                'create_link' => 0,
            ],
            [
                'id' => 7,
                'name' => 'US Report',
                'code' => '[{"bmr_no":"10","production_id":"10","pages":[{"page_name":"US Report","page_type":"2","html_code":"<p>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n<meta name=\"ProgId\" content=\"Word.DocumentW\" />..."}]}]',
                'created_by' => '202',
                'created_on' => '2023-01-13 16:34:04',
                'template_id' => 1,
                'type' => 1,
                'status' => 1,
                'company_id' => 'Firm_26467',
                'is_dashboard' => 0,
                'from_tally' => 2,
                'tally_company_id' => 3,
                'tally_branch_id' => 3,
                'exchange_rate' => null,
                'report_type' => 1,
                'template_type' => 1,
                'template_check_permission' => 1,
                'create_link' => 0,
            ],
        ]);
    
    }
}
