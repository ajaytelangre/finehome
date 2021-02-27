<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_logins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('mobile')->uniquie();
            $table->string("work_name")->nullable();
            $table->string("partner_name")->nullable();
            $table->string("email")->nullable();
            $table->Integer("age")->nullable();
            $table->string("address")->nullable();
            $table->string("city")->nullable();
            $table->string("partner_img")->nullable();
            $table->string("adhar_img")->nullable();
            $table->string("pan_img")->nullable();
            $table->string("address_proof")->nullable();
            $table->string("name_on_passbook")->nullable();
            $table->string("account_num")->nullable();
            $table->string("ifsc")->nullable();
            $table->string("passbook")->nullable();

            
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
        Schema::dropIfExists('partner_logins');
    }
}
