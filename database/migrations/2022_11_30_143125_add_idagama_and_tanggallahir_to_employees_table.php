<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->bigInteger('id_religions')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->bigInteger('id_departments')->nullable();
            $table->bigInteger('id_jobs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('id_religions')->nullable();
            $table->dropColumn('tanggal_lahir')->nullable();
            $table->dropColumn('id_departments')->nullable();
            $table->dropColumn('id_jobs')->nullable();
        });
    }
};
