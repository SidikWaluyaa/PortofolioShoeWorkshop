<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * A donation filled in on the public form before the donor signed in.
 * The draft id lives in the session until login, then the draft belongs to the user,
 * so it survives email verification opened in another browser.
 */
class DonationDraft extends Model
{
    public const SESSION_KEY = 'donation_draft_id';
    public const KEEP_DAYS = 7;

    protected $fillable = ['user_id', 'data', 'foto_path'];

    protected $casts = [
        'data' => 'array',
        'foto_path' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** The draft started in this browser session, if it has not been claimed by someone else. */
    public static function fromSession(?User $user = null): ?self
    {
        $id = session(self::SESSION_KEY);
        if (!$id) {
            return null;
        }

        return self::whereKey($id)
            ->where(fn ($q) => $q->whereNull('user_id')->when($user, fn ($q) => $q->orWhere('user_id', $user->id)))
            ->first();
    }

    /** The draft waiting to be sent by this user: the one from this session first, then the newest one saved to the account. */
    public static function current(User $user): ?self
    {
        self::claimFromSession($user);

        return self::where('user_id', $user->id)->latest('id')->first();
    }

    /** Called on login and registration: the draft started as a guest now belongs to the user. Older drafts of the user are dropped. */
    public static function claimFromSession(User $user): void
    {
        $draft = self::fromSession($user);
        if (!$draft) {
            return;
        }

        if ($draft->user_id !== $user->id) {
            $draft->update(['user_id' => $user->id]);
        }

        self::where('user_id', $user->id)->whereKeyNot($draft->id)->get()->each->discard();
    }

    /** Remove the draft and its photos (used when the draft is abandoned, not when it is sent). */
    public function discard(): void
    {
        Storage::disk('public')->delete($this->foto_path ?? []);
        $this->delete();
    }

    public static function pruneStale(): void
    {
        self::where('updated_at', '<', now()->subDays(self::KEEP_DAYS))->get()->each->discard();
    }
}
