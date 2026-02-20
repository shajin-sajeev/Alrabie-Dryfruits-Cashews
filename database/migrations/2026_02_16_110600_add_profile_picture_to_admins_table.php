<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates profile_picture as `text` column so no separate ALTER migration is needed.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('admins', 'profile_picture')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->text('profile_picture')->nullable()->after('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('admins', 'profile_picture')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('profile_picture');
            });
        }
    }
};
