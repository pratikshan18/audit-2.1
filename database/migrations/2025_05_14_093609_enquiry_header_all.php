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
        Schema::create('enquiry_header_all', function (Blueprint $table) {
            $table->id();
            $table->string('enquiry_id', 100);
            $table->string('customer_id', 100);
            $table->date('date_of_enquiry');
            $table->string('service_id', 100)->comment('main service id');
            $table->string('offering_id', 100)->comment('offerings id');
            $table->integer('enquiry_from')->default(2)->comment('1=from Web and 2=from portal');
            $table->string('allot_to', 250)->comment('user_id');
            $table->dateTime('alloted_on');
            $table->integer('is_revised')->comment('1=yes,0=no');
            $table->text('remark');
            $table->text('upload_file');
            $table->string('firm_id', 150);
            $table->string('close_enq_reason', 1000);
            $table->integer('status')->comment('1-not-initiate,2-initiate,3-progress,4-complete,5-close,6-converted');
            $table->string('customer_email', 250)->comment('customer email');
            $table->string('customer_contact', 250)->comment('customer contact number');
            $table->string('customer_name', 250)->comment('customer name');
            $table->string('customer_pan_no', 250);
            $table->string('customer_gst_no', 45)->nullable();
            $table->date('created_on');
            $table->string('created_by', 200);
            $table->dateTime('modified_on');
            $table->string('modified_by', 200);
            $table->integer('web_info_filled_status')->comment('1=yes,0=no');
            $table->string('transaction_status', 45)->default('0')->comment('0=no,1=yes');
            $table->string('web_reference_id', 45)->comment('reference id if enquiry is from web');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry_header_all');
    }
};
