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
         Schema::create('tbl_temp_tab_input', function (Blueprint $table) {
            $table->id();
            $table->string('temp_id', 45);
            $table->string('name', 45);
            $table->longText('json');
            $table->string('created_by', 45)->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('status', 45)->default('1')->comment('1.active 0.deactive');
            // If you're using Laravel timestamps, you can optionally enable these:
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_temp_tab_input');
    }
};
