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
        Schema::create('task_history', function (Blueprint $table) {
             $table->bigIncrements('id')->unsigned(); // Use unsigned for auto-increment

            // Add the rest of the columns
            $table->string('task_id');
            $table->string('task_status');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_history');
    }
};
