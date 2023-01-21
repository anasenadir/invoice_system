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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name' , 30);
            $table->string('customer_email' , 50);
            $table->string('customer_mobile' , 15);
            $table->string('company_name' , 30);
            $table->string('invoice_number' , 20);
            $table->dateTime('invoice_date');

            $table->float('sub_total');
            $table->string('discount_type' , 10);
            $table->float('discount_value');
            $table->float('vat');
            $table->float('shipping');
            $table->float('total_due');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
