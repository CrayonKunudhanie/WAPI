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
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->string('bcname');
            $table->dateTime('waktu')->nullable();
            $table->text('message');
            $table->string('image')->nullable();
            $table->boolean('showbutton')->default(false);
            $table->text('namabutton')->nullable();
            $table->text('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('broadcasts', function (Blueprint $table) {
            $table->dropColumn(['bcname', 'waktu', 'message', 'image', 'showbutton', 'namabutton', 'link']);
        });
    }
};
