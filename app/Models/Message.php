<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Message extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'code',
        'share_token',
        'sender_name',
        'recipient_name',
        'title',
        'message',
        'unlock_at',
        'opened_at',
    ];

    /**
     * Relasi ke User pemilik pesan (nullable — pesan lama bersifat anonim).
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'unlock_at' => 'datetime',
            'opened_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Determine if the message is already unlocked.
     */
    public function isUnlocked(): bool
    {
        return Carbon::now(config('app.timezone', 'Asia/Jakarta'))->greaterThanOrEqualTo($this->unlock_at);
    }

    /**
     * Determine if the message is still locked.
     */
    public function isLocked(): bool
    {
        return Carbon::now(config('app.timezone', 'Asia/Jakarta'))->lessThan($this->unlock_at);
    }

    /**
     * Check if the message can still be edited (only before unlock time).
     */
    public function canBeEdited(): bool
    {
        return $this->isLocked();
    }

    /**
     * Mark the message as opened upon user request after unlock time.
     */
    public function markAsOpened(): void
    {
        if ($this->isUnlocked() && is_null($this->opened_at)) {
            $this->update(['opened_at' => Carbon::now(config('app.timezone', 'Asia/Jakarta'))]);
        }
    }

    /**
     * Get safe PDF file name.
     */
    public function getPdfFilename(): string
    {
        $target = $this->recipient_name ?: $this->sender_name ?: 'penerima';
        $safeSlug = Str::slug($target, '-');
        $year = $this->unlock_at ? $this->unlock_at->format('Y') : date('Y');

        return "pesan-untuk-masa-depan-{$safeSlug}-{$year}.pdf";
    }

    /**
     * Generate a cryptographically secure, unique code in XXXX-XXXX format.
     */
    public static function generateUniqueCode(): string
    {
        $charset = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $maxIndex = strlen($charset) - 1;

        do {
            $part1 = '';
            $part2 = '';
            for ($i = 0; $i < 4; $i++) {
                $part1 .= $charset[random_int(0, $maxIndex)];
                $part2 .= $charset[random_int(0, $maxIndex)];
            }
            $code = "{$part1}-{$part2}";
        } while (static::where('code', $code)->exists());

        return $code;
    }

    /**
     * Generate a cryptographically secure unique share token.
     */
    public static function generateUniqueShareToken(): string
    {
        do {
            $token = Str::random(32);
        } while (static::where('share_token', $token)->exists());

        return $token;
    }

    /**
     * Normalize user-provided code input to XXXX-XXXX format.
     */
    public static function normalizeCode(?string $input): string
    {
        if (empty($input)) {
            return '';
        }

        $cleaned = strtoupper(trim($input));
        $alphanumeric = preg_replace('/[^A-Z0-9]/', '', $cleaned);

        if (strlen($alphanumeric) === 8 && !str_contains($cleaned, '-')) {
            return substr($alphanumeric, 0, 4) . '-' . substr($alphanumeric, 4, 4);
        }

        return $cleaned;
    }
}
