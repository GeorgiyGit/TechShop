<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('contact_first_name', 100)->nullable()->after('user_id');
            $table->string('contact_last_name', 100)->nullable()->after('contact_first_name');
            $table->string('contact_email', 255)->nullable()->after('contact_last_name');
            $table->string('contact_phone', 40)->nullable()->after('contact_email');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['contact_first_name', 'contact_last_name', 'contact_email', 'contact_phone']);
        });
    }
};
