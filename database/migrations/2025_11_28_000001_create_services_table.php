<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 30);
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('role')->nullable();
            $table->date('date')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('chassis_no')->nullable();
            $table->string('model')->nullable();
            $table->time('entry_time')->nullable();
            $table->string('job_no')->nullable();
            $table->text('job_description')->nullable();
            $table->string('drv_name')->nullable();
            $table->decimal('tk_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
