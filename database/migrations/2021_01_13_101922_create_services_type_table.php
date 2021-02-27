<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_type', function (Blueprint $table) {
            $table->id();
            $table->Integer("service_id");
            $table->string("service_type");
            $table->string("sub_type");
            $table->float("price",8,2);
            $table->string("img");
            $table->float("rating",2,1);
            $table->string("description");


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_type');
    }
}
