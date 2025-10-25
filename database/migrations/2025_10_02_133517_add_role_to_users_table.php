<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('customer');
        });

        // ✅ Add a check constraint to allow only 'customer' or 'seller'
        DB::statement("ALTER TABLE users ADD CONSTRAINT role_check CHECK (role IN ('customer', 'seller'))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove constraint first
        DB::statement("ALTER TABLE users DROP CONSTRAINT IF EXISTS role_check");

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
