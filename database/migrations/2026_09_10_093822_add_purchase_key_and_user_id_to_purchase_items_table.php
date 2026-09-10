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
        Schema::table('purchase_items', function (Blueprint $table) {
            if (! Schema::hasColumn('purchase_items', 'purchase_key')) {
                $table->string('purchase_key')->unique()->after('id');
            }

            if (! Schema::hasColumn('purchase_items', 'user_id')) {
                $table->foreignId('user_id')->constrained('users')->after('author_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_items', function (Blueprint $table) {
            if (Schema::hasColumn('purchase_items', 'user_id')) {
                $table->dropForeign(['user_id']);
            }

            $table->dropColumn(array_filter([
                Schema::hasColumn('purchase_items', 'purchase_key') ? 'purchase_key' : null,
                Schema::hasColumn('purchase_items', 'user_id') ? 'user_id' : null,
            ]));
        });
    }
};
