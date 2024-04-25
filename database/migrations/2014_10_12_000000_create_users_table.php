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
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('username');
      $table->string('password');
    });

    Schema::create('materialList', function (Blueprint $table) {
      $table->id();
      $table->string('item');
      $table->double('price');
      $table->string('unit');
    });

    Schema::create('workerList', function (Blueprint $table) {
      $table->id();
      $table->string('labor');
      $table->double('rate');
    });

    Schema::create('requestorList', function (Blueprint $table) {
      $table->id();
      $table->string('requestor');
      $table->string('department');
      $table->integer('local');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
