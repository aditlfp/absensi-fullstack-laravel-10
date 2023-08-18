<?php

use App\Models\Kerjasama;
use App\Models\Point;
use App\Models\Shift;
use App\Models\TipeAbsensi;
use App\Models\User;
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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Kerjasama::class, 'kerjasama_id');
            $table->foreignIdFor(Shift::class, 'shift_id');
            $table->foreignIdFor(TipeAbsensi::class, 'tipe_id')->nullable();
            $table->string('perlengkapan')->nullable();
            $table->string('keterangan');
            $table->string('deskripsi');
            $table->string('absensi_type_masuk');//pulang/masuk
            $table->string('tanggal_absen');
            $table->string('absensi_type_pulang')->nullable();//pulang/masuk
            $table->string('image');//foto
            $table->foreignIdFor(Point::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
