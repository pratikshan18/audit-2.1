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
        Schema::create('audit_user_header_all', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->unsignedBigInteger('user_type')->comment('1:superadmin;2:admin,3:audit manager,4:Audit Engagement Partner,5:Senior Auditor,6:customer,7-IT Audit Specialist, 8-Tax Audit Specialist, 9-Junior Auditor, 10-Audit Assistant, 11-Auditor');
            $table->unsignedBigInteger('firm_id')->nullable();
            $table->string('user_name');
            $table->string('mobile_no')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('created_by')->nullable();
            $table->string('activity_status')->nullable();
            $table->string('cab_id')->nullable()->comment('company_id');
            $table->text('status')->nullable()->comment('Detailed description of the action');
            $table->timestamp('created_on');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_user_header_all');
    }
};
