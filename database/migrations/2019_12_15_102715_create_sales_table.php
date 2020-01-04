<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->unsignedBigInteger('delivery_company_id');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->date('date');
            $table->string('client_name');
            $table->string('client_address');
            $table->string('client_phone');
            $table->string('client_email')->nullable();
            $table->boolean('handed_over');
            $table->enum('delivered', ['yes', 'partial', 'no']);
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
        Schema::dropIfExists('sales');
    }
}
