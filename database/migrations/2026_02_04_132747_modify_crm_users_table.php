<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Uruchom migracje.
     */
    public function up(): void
    {
        Schema::table('crm_users', function (Blueprint $table) {
            $table->renameColumn('name', 'first_name');
            $table->string('last_name', 300)->nullable()->after('first_name');
            $table->string('stand_name', 300)->nullable()->after('last_name');
            $table->string('symbol', 2)->nullable()->after('stand_name');
            $table->string('department', 300)->nullable()->after('symbol');
            $table->text('description')->nullable()->after('department');
            $table->string('phone', 80)->nullable()->after('email');
            $table->tinyInteger('user_level')->nullable()->after('phone');
            $table->enum('active', ['0', '1'])->default('1')->after('user_level');
            $table->text('additional')->nullable()->after('active');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::table('crm_users', function (Blueprint $table) {
            $table->renameColumn('first_name', 'name');
            $table->dropColumn([
                'last_name',
                'stand_name',
                'symbol',
                'department',
                'description',
                'phone',
                'user_level',
                'active',
                'additional',
            ]);
        });
    }
};
