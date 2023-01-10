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
        Schema::create('callback_to_merchants', function (Blueprint $table) {
            $table->id();
            $table->string('is_success')->nullable();
            $table->string('is_server_error')->nullable();
            $table->string('status_code')->nullable();
            $table->string('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('callback_to_merchants');
    }
};
