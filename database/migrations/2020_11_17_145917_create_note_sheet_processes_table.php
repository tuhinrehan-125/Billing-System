<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteSheetProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_sheet_processes', function (Blueprint $table) {
            $table->id();
            $table->string('notesheet_id')->nullable();
            $table->string('chairmen_status')->nullable();
            $table->string('managing_director_status')->nullable();
            $table->string('director_finance_status')->nullable();
            $table->string('director_admin_status')->nullable();
            $table->string('accounts_admin_status')->nullable();
            $table->string('clearence_status')->nullable();
            $table->string('delete_status')->default(0);

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
        Schema::dropIfExists('note_sheet_processes');
    }
}
