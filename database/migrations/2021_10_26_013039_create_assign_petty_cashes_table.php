<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignPettyCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_petty_cashes', function (Blueprint $table) {
            $table->id();
            $table->date('petty_cash_date')->nullable();
            $table->date('receipt_date')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('amount')->nullable();
            $table->date('petty_cash_date_generated')->nullable();
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
        Schema::dropIfExists('assign_petty_cashes');
    }
}
