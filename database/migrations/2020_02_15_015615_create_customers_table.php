<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('customerNumber');
            $table->string('customerName', 50)->nullable(false);
            $table->string('contactLastName', 50)->nullable(false);
            $table->string('contactFirstName', 50)->nullable(false);
            $table->string('phone', 50)->nullable(false);
            $table->string('addressLine1', 50)->nullable(false);
            $table->string('addressLine2', 50)->nullable();
            $table->string('city', 50)->nullable(false);
            $table->string('state', 50)->nullable();
            $table->string('postalCode', 15)->nullable();
            $table->string('country', 50)->nullable(false);
            $table->string('salesRepEmployeeNumber', 11)->nullable();
            $table->decimal('creditLimit', 10,2)->nullable();
            
            $table->foreign('salesRepEmployeeNumber')->references('employeeNumber')->on('employees');

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
