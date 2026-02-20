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
        if (!Schema::hasColumn('admins', 'profile_picture')) {
            Schema::table('admins', function (Blueprint $col) {
                $col->string('profile_picture')->nullable()->after('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('admins', 'profile_picture')) {
            Schema::table('admins', function (Blueprint $col) {
                $col->dropColumn('profile_picture');
            });
        }
    }
};
