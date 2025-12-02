<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_user', function (Blueprint $table) {
            $table->string('quote_status')->default('sin_cotizar')->after('service_id');
            $table->timestamp('quote_sent_at')->nullable()->after('quote_status');
        });
    }

    public function down(): void
    {
        Schema::table('service_user', function (Blueprint $table) {
            $table->dropColumn(['quote_status', 'quote_sent_at']);
        });
    }
};
