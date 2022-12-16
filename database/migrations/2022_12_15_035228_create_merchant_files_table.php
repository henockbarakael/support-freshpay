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
        Schema::create('merchant_files', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->nullable();
            $table->string('thirdparty_reference')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('method')->nullable();
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
            $table->string('customer_details')->nullable();
            $table->string('paydrc_reference')->nullable();
            $table->string('status')->nullable();
            $table->string('action')->nullable();
            $table->string('switch_reference')->nullable();
            $table->string('telco_reference')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_files');
    }
};
