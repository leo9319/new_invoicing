<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_name_id');
            $table->unsignedBigInteger('district_id');
            $table->string('zone');
            $table->integer('rate');
            $table->decimal('cod_charge', 4, 2);
            $table->string('type');
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
        Schema::dropIfExists('delivery_companies');
    }
}
