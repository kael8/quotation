<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('inCharge', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('department');
    });

    Schema::create('quotation_record', function (Blueprint $table) {
      $table->id();
      $table->string('quotation_number');
      $table->date('quotation_date');
      $table->date('validity');
      $table->string('reference_number');
      $table->integer('requestor_id');
      $table->integer('quotation_to_id');
      $table->integer('inCharge_id');
      $table->text('subject');
      $table->text('letter');
      $table->double('overhead_profit');
      $table->string('quotation_id');
    });

    Schema::create('employees', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('position');
    });

    Schema::create('item_records', function (Blueprint $table) {
      $table->id();
      $table->integer('materialList_id');
      $table->integer('quantity');
      $table->string('quotation_id');
    });

    Schema::create('labor_records', function (Blueprint $table) {
      $table->id();
      $table->integer('workerList_id');
      $table->integer('count');
      $table->integer('working_days');
      $table->string('quotation_id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    //
  }
};
