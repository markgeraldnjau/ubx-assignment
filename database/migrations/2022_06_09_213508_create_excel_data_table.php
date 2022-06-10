<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcelDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excel_data', function (Blueprint $table) {
            $table->id();
            $table->string('cargo_no');
            $table->string('cargo_type');
            $table->string('cargo_size');
            $table->string('weight');
            $table->string('remarks')->nullable();
            $table->string('wharfage');
            $table->string('penalty');
            $table->string('storage');
            $table->string('electricity');
            $table->string('destuffing');
            $table->string('lifting');
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
        Schema::dropIfExists('excel_data');
    }
}
