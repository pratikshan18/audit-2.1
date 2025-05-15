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
        Schema::create('mapp_template_stages', function (Blueprint $table) {
            $table->id();

            // Fields based on your SQL structure
            $table->string('template_id', 45)->nullable()->comment('subprocess is a template id');
            $table->text('stage_name')->nullable();
            $table->string('created_by', 45)->nullable();
            $table->dateTime('created_on')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('firm_id', 45)->nullable();
            $table->integer('status')->default(1);
            $table->string('process_id', 45)->nullable()->comment('child id of main template');

            // Laravel timestamps (created_at, updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('mapp_template_stages');
    }
};
