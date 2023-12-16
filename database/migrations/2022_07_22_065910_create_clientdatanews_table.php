<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientdatanews', function (Blueprint $table) {
            $table->id();
            $table->string('remark')->nullable();
            $table->string('agent_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->string('interaction_type')->nullable();
            $table->string('product_type')->nullable();
            $table->string('contact_reason')->nullable();
            $table->string('contact_reason_type')->nullable();
            $table->string('contact_reason_sub_sub_type')->nullable();
            $table->string('booking_id')->nullable();
            $table->string('chasis_number')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('warranty_status')->nullable();
            $table->string('call_status_sub_type')->nullable();
            $table->string('call_status_sub_sub_type')->nullable();
            $table->string('final_call_status')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('city')->nullable();
            $table->string('dealership')->nullable();
            $table->string('dealership_location')->nullable();
            $table->string('call_status')->nullable();
            $table->string('pincode')->nullable();
            $table->string('ticket_no')->nullable();
            $table->integer('ticket_id')->nullable();
            $table->string('ResolutionProvided')->nullable();
            $table->string('product_issue')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientdatanews');
    }
};
