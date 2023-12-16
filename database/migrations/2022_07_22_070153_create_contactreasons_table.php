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
        Schema::create('contactreasons', function (Blueprint $table) {
            $table->id();
            $table->string('contact_reason')->nullable();
            $table->string('contact_reason_sub_type')->nullable();
            $table->string('contact_reason_sub_sub_type')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactreasons');
    }
};
