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
       Schema::create('temp_master_child_mapping', function (Blueprint $table) {
            $table->id();
            $table->integer('master_temp_id')->nullable();
            $table->integer('child_process_temp_id')->nullable();
            $table->integer('dependant_temp_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1:active;0:inactive');
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by', 45)->nullable();
            $table->integer('sequence')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_master_child_mapping');
    }
};
