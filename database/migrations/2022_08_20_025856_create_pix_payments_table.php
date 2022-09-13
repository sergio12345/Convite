<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePixPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pix_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('invitee_id');
            $table->decimal('amount', $precision = 10, $scale = 2);
            $table->string('transaction_id');
            $table->string('pdf');
            $table->string('link')->nullable();
            $table->string('brcode')->nullable();
            $table->enum('status', ['created', 'paid', 'credited'])->default('created');
            
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
        Schema::dropIfExists('pix_payments');
    }
}
