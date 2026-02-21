<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('admins', 'profile_picture')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->text('profile_picture')->nullable()->after('email');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('admins', 'profile_picture')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('profile_picture');
            });
        }
    }
};
