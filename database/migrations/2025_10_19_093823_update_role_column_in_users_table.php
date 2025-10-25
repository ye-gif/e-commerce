<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        
        DB::statement("UPDATE users SET role = 'customer' WHERE role NOT IN ('customer', 'seller') OR role IS NULL");

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('customer')->change();
        });

        // Add the check constraint safely
        DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('customer', 'seller'))");
    }

    public function down(): void
    {
        // Remove constraint on rollback
        DB::statement("ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check");

        // Revert the default back to 'user'
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->change();
        });
    }
};
