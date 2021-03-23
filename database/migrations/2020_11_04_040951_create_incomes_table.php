<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('project_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('working_day')->nullable();
            $table->string('paid')->nullable();
            $table->string('due')->nullable();
            $table->string('date')->nullable();
            $table->string('comments')->nullable();
            $table->string('user_id')->nullable();
            $table->string('delete_status')->default(1);
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
        Schema::dropIfExists('incomes');
    }
}
