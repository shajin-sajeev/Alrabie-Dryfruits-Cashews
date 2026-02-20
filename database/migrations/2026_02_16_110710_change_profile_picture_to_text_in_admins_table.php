<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Ensures the profile_picture column is of type TEXT.
     * Uses a raw query to avoid doctrine/dbal dependency issues.
     */
    public function up(): void
    {
        if (Schema::hasColumn('admins', 'profile_picture')) {
            // Use raw SQL to safely alter the column type — works on PostgreSQL without doctrine/dbal
            $driver = DB::getDriverName();
            if ($driver === 'pgsql') {
                DB::statement('ALTER TABLE admins ALTER COLUMN profile_picture TYPE TEXT');
            } elseif ($driver === 'mysql' || $driver === 'mariadb') {
                DB::statement('ALTER TABLE admins MODIFY COLUMN profile_picture TEXT');
            }
            // SQLite supports TEXT by default, no change needed
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('admins', 'profile_picture')) {
            $driver = DB::getDriverName();
            if ($driver === 'pgsql') {
                DB::statement('ALTER TABLE admins ALTER COLUMN profile_picture TYPE VARCHAR(255)');
            } elseif ($driver === 'mysql' || $driver === 'mariadb') {
                DB::statement('ALTER TABLE admins MODIFY COLUMN profile_picture VARCHAR(255)');
            }
        }
    }
};
