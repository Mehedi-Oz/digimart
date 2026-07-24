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
        Schema::create('kyc_settings', function (Blueprint $table) {
            $table->id();
            $table->text('instructions')->nullable();
            $table->boolean('nid_verification')->default(0);
            $table->boolean('passport_verification')->default(0);
            $table->boolean('auto_approve')->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_settings');
    }
};
