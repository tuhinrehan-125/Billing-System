<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeDuePaidHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_due_paid_histories', function (Blueprint $table) {
            $table->id();
            $table->string('income_id')->nullable();
            $table->string('paid')->nullable();
            $table->string('comment')->nullable();
            $table->string('date')->nullable();
            $table->string('collector')->nullable();
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
        Schema::dropIfExists('income_due_paid_histories');
    }
}
