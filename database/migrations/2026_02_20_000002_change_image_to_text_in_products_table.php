<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE "products" ALTER COLUMN "image" TYPE TEXT');
        } elseif (in_array($driver, ['mysql', 'mariadb'])) {
            DB::statement('ALTER TABLE `products` MODIFY COLUMN `image` TEXT NULL');
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE "products" ALTER COLUMN "image" TYPE VARCHAR(255)');
        } elseif (in_array($driver, ['mysql', 'mariadb'])) {
            DB::statement('ALTER TABLE `products` MODIFY COLUMN `image` VARCHAR(255) NULL');
        }
    }
};
