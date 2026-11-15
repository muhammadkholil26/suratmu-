<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('recipient_name')->nullable()->after('sender_name');
            $table->string('title')->nullable()->after('recipient_name');
            $table->string('share_token', 64)->nullable()->unique()->after('code');
            $table->dateTime('opened_at')->nullable()->after('unlock_at');
        });

        // Populate existing rows with default values and unique share tokens
        $existing = DB::table('messages')->get();
        foreach ($existing as $row) {
            DB::table('messages')->where('id', $row->id)->update([
                'recipient_name' => $row->recipient_name ?? 'Sahabat Masa Depan',
                'title' => $row->title ?? 'Surat Waktu',
                'share_token' => Str::random(32),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['recipient_name', 'title', 'share_token', 'opened_at']);
        });
    }
};

