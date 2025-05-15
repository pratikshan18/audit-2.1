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
        // Schema::create('audit_orgnizations', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        Schema::create('audit_orgnizations', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('short_name');
            $table->text('address');
            $table->string('com_reg_detail');
            $table->string('company_logo');
            $table->string('status');
            $table->string('firm_id');
            $table->string('cab_id');
            $table->integer('profile_access');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_orgnizations');
    }
};
