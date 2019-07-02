<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('suppliers_id');
            $table->unsignedBigInteger('company_id')->nullable(false);
            $table->string('suppliers_name')->nullable(false);
            $table->string('suppliers_email');
            $table->float('suppliers_fee',10,2);
            $table->boolean('activated')->default(false);
            $table->foreign('company_id')->references('company_id')->on('company');
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
        Schema::dropIfExists('suppliers');
    }
}
