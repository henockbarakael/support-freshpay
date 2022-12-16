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
        Schema::create('transaction_verifies', function (Blueprint $table) {
            $table->id();
            $table->string('customer_number')->nullable();
            $table->string('paydrc_reference')->nullable();
            $table->string('switch_reference')->nullable();
            $table->string('status')->nullable();
            $table->string('trans_partid')->nullable();
            $table->string('financial_institution_id')->nullable();
            $table->string('financial_status_description')->nullable();
            $table->string('resultCode')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('transaction_verifies');
    }
};
