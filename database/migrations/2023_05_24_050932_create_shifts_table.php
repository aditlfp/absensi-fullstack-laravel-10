<?php

use App\Models\Client;
use App\Models\Jabatan;
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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Jabatan::class, 'jabatan_id');
            $table->foreignIdFor(Client::class, 'client_id');
            $table->string('shift_name');
            $table->string('jam_start');
            $table->string('jam_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
