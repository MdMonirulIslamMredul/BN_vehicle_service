<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // MySQL-specific default change without requiring doctrine/dbal
        if (Schema::hasTable('users')) {
            DB::statement("ALTER TABLE users MODIFY is_active TINYINT(1) NOT NULL DEFAULT 0");
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            DB::statement("ALTER TABLE users MODIFY is_active TINYINT(1) NOT NULL DEFAULT 1");
        }
    }
};
