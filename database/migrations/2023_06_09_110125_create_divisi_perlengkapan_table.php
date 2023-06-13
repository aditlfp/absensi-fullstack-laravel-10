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
        Schema::create('divisi_perlengkapan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('divisi_id');
            $table->unsignedBigInteger('perlengkapan_id');
            $table->timestamps();

            $table->foreign('divisi_id')->references('id')->on('divisis')->onDelete('cascade');
            $table->foreign('perlengkapan_id')->references('id')->on('perlengkapans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisi_perlengkapan');
    }
};
