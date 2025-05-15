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
         Schema::create('production_scheduler_bmr_report', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('code')->nullable();
            $table->string('created_by', 45)->nullable();
            $table->timestamp('created_on')->useCurrent();
            $table->integer('report_id')->default(1);
            $table->string('item_id', 255)->nullable()->comment('type : 1 - item_id, 2 - schedule_id');
            $table->string('card_id', 255)->nullable()->comment('type : 1 - card_id;2 - work_id');
            $table->string('board_id', 255)->nullable();
            $table->integer('status')->default(1);
            $table->integer('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('type')->default(1)->comment('1:rmt;2:planning and scheduling');
            $table->string('file_name', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_scheduler_bmr_report');
    }
};
