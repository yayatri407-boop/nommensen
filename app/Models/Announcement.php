<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'users_id',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($announcement) {
            if (empty($announcement->slug) && !empty($announcement->title)) {
                $announcement->slug = Str::slug($announcement->title);
            }
            if (empty($announcement->users_id)) {
                $announcement->users_id = auth()->id();
            }
        });
    }

    /**
     * Relasi: Announcement ini dimiliki oleh (dibuat oleh) satu User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}