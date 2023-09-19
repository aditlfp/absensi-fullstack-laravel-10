<?php

use App\Models\Client;
use App\Models\Shift;
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
        Schema::create('report_brefs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class);
            $table->string('tanggal');
            $table->foreignIdFor(Shift::class);
            $table->string('hadir')->nullable();
            $table->string('spv')->nullable();
            $table->string('tl')->nullable();
            $table->string('ocs')->nullable();
            $table->integer('tanpa_keterangan')->nullable();
            $table->integer('izin_atau_cuti')->nullable();
            $table->integer('sakit')->nullable();
            $table->integer('off')->nullable();
            $table->integer('total_mp')->nullable();
            $table->string('materi_breafing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_brefs');
    }
};
