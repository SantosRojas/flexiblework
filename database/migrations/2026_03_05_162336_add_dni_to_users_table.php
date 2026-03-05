<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('dni')->nullable()->after('email');
        });

        // SQL Server no permite múltiples NULLs en un índice UNIQUE,
        // por lo que se usa un filtered index. MySQL sí lo permite nativamente.
        if (DB::getDriverName() === 'sqlsrv') {
            DB::statement('CREATE UNIQUE INDEX users_dni_unique ON users (dni) WHERE dni IS NOT NULL');
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->unique('dni');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'sqlsrv') {
            DB::statement('DROP INDEX IF EXISTS users_dni_unique ON users');
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique(['dni']);
            });
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('dni');
        });
    }
};
