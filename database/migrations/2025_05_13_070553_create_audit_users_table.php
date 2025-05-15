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
    Schema::create('audit_users', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('user_type')->nullable();
        $table->unsignedBigInteger('firm_id')->nullable();
        $table->string('user_name');
        $table->string('mobile_no')->nullable();
        $table->string('email')->unique();
        $table->string('password');
        $table->timestamp('created_on')->nullable();
        $table->unsignedBigInteger('created_by')->nullable();
        $table->string('activity_status')->nullable();
        $table->string('profile_access')->nullable();
        $table->string('profile_type')->nullable();
        $table->string('technical_area')->nullable();

        $table->longText('profile_html')->nullable();
        $table->string('status')->nullable();
        $table->unsignedBigInteger('cab_id')->nullable();
        $table->string('co_location')->nullable();
        $table->string('auditor_position')->nullable();
        $table->string('nationality')->nullable();
        $table->json('menu_access')->nullable();
        $table->unsignedBigInteger('company_id')->nullable();
        $table->json('permissions')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_users');
    }
};
