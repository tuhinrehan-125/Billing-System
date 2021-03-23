<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpanseDuePaidHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expanse_due_paid_histories', function (Blueprint $table) {
            $table->id();
            $table->string('expanse_id')->nullable();
            $table->string('paid')->nullable();
            $table->string('comment')->nullable();
            $table->string('date')->nullable();
            $table->string('user_id')->nullable();
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
        Schema::dropIfExists('expanse_due_paid_histories');
    }
}
