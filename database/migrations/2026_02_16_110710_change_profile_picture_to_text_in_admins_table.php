<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('admins', 'profile_picture')) {
            $driver = DB::getDriverName();
            if ($driver === 'pgsql') {
                DB::statement('ALTER TABLE admins ALTER COLUMN profile_picture TYPE TEXT');
            } elseif ($driver === 'mysql' || $driver === 'mariadb') {
                DB::statement('ALTER TABLE admins MODIFY COLUMN profile_picture TEXT');
            }
        }
    }
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
