<?php

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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->string('leader_name')->nullable();
            $table->string('mitra_name')->nullable();
            $table->boolean('isLeader')->default(false);
            $table->boolean('isMitra')->default(false);
            $table->foreignIdFor(User::class, 'user_id');
            $table->string('rate_mitra')->nullable()->default('0');
            $table->string('rate_leader')->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
