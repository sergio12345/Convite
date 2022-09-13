<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->decimal('goal', $precision = 10, $scale = 2)->nullable();
            $table->enum('type', ['presential', 'virtual'])->default('presential');
            $table->string('address')->nullable();
            $table->dateTime('date_rsvp')->nullable();
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->enum('fundraising', ['active', 'inactive'])->default('inactive');
            $table->enum('status', ['published', 'unpublished'])->default('published');
            
            $table->enum('fundraising_after_goal', ['active', 'inactive'])->default('inactive');
            $table->enum('fundraising_after_date', ['active', 'inactive'])->default('inactive');
            $table->enum('status_after_date', ['published', 'unpublished'])->default('unpublished');
            $table->integer('tax_charity')->nullable()->default('0');
            $table->integer('institution_id')->nullable();

            $table->string('token')->nullable();

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
        Schema::dropIfExists('campaigns');
    }
}
