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
        Schema::create('web_customer_service', function (Blueprint $table) {
            $table->id(); // Auto-increment INT primary key
            $table->string('ref_enquiry_id', 45);
            $table->string('name', 100)->comment('name of the customer');
            $table->unsignedBigInteger('contact_no')->comment('contact no');
            $table->string('email_id', 100)->comment('email id');
            $table->string('service_name', 1000);
            $table->string('offering_name', 1000);
            $table->string('details', 1000);
            $table->string('status', 45)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_customer_service');
    }
};
