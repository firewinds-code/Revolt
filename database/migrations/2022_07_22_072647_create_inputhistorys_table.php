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
        Schema::create('inputhistorys', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no')->nullable();
            $table->string('agent_id')->nullable();
            $table->string('remark')->nullable();
            $table->string('ResolutionProvided')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->string('final_call_status')->nullable();
            $table->string('call_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inputhistorys');
    }
};
