<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('word_reportMaker_table', function (Blueprint $table) {
            $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('name')->nullable();
            $table->longText('code')->nullable();
            $table->string('created_by', 45)->nullable();
            $table->dateTime('created_on')->useCurrent();
            $table->unsignedInteger('template_id')->default(1);
            $table->unsignedTinyInteger('type')->default(1)->comment('1:Board, 2:Planning');
            $table->unsignedTinyInteger('status')->default(1)->comment('1:active, 0:inactive');
            $table->string('company_id', 45)->nullable();
            $table->unsignedTinyInteger('is_dashboard')->default(0)->comment('0: No, 1: Yes');
            $table->unsignedTinyInteger('from_tally')->default(1)->comment('1: no; 2: yes');
            $table->unsignedInteger('tally_company_id')->nullable();
            $table->unsignedInteger('tally_branch_id')->nullable();
            $table->double('exchange_rate')->nullable();
            $table->unsignedTinyInteger('report_type')->default(1)->comment('1: Child, 2: sub process, 3: Master');
            $table->unsignedTinyInteger('template_type')->default(1)->comment('1 - Word Template, 2 - Excel Template');
            $table->unsignedTinyInteger('template_check_permission')->nullable()->comment('editable = 1, not editable = 0');
            $table->unsignedTinyInteger('create_link')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_reportMaker_table');
    }
};
