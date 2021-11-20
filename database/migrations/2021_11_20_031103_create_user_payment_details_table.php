<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->string('card_brand');
            $table->string('card_last_four', 4);
            $table->string('billing_plan');
            $table->dateTime('trial_starts_at');
            $table->dateTime('trial_ends_at');
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
        Schema::dropIfExists('user_payment_details');
    }
}
