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
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('tasks_employee_id_foreign');
            $table->dropColumn('employee_id');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id')->nullable()->after('training_id');
            $table->foreign('employee_id')->references('id')->on('employees')->nullOnDelete();
            $table->unsignedBigInteger('manager_id')->nullable()->after('training_id');
            $table->foreign('manager_id')->references('id')->on('managers')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }
};
