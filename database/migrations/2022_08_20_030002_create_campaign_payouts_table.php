<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignPayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_payouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('campaign_id');
            $table->enum('type', ['host_payout', 'charity_payout'])->default('host_payout');
            $table->decimal('amount', $precision = 10, $scale = 2);
            $table->string('attachment');
            $table->unsignedInteger('institution_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_payouts');
    }
}
