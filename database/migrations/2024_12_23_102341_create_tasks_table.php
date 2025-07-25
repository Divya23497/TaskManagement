<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            // Create id as auto-incrementing primary key
            $table->bigIncrements('id')->unsigned(); // Use unsigned for auto-increment

            // Add the rest of the columns
            $table->string('task_name')->unique();
            $table->string('client_name');
            $table->string('task_type');
            $table->string('task_desc');
            $table->text('task_content');
            $table->string('task_status');
            $table->integer('assigned_to');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        // Drop the tasks table if rollback is needed
        Schema::dropIfExists('tasks');
    }
}

