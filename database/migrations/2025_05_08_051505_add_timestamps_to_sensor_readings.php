<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('sensor_readings', function (Blueprint $table) {
        $table->timestamps(); // tambah created_at & updated_at
    });
}

public function down()
{
    Schema::table('sensor_readings', function (Blueprint $table) {
        $table->dropColumn(['created_at', 'updated_at']);
    });
}

};
