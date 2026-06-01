<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'observed_at',
        'location',
        'description',
        'category',
        'photo',
        'status',
    ];

    protected $casts = [
        'observed_at' => 'datetime',
    ];

    public static array $categories = [
        'lights'  => 'Mysterieuze lichten',
        'object'  => 'Onbekend vliegend object',
        'sound'   => 'Onverklaarbaar geluid',
        'contact' => 'Mogelijk contact',
        'trace'   => 'Fysiek spoor of afdruk',
        'other'   => 'Anders',
    ];

    public static array $statuses = [
        'new'         => 'Nieuw',
        'in_progress' => 'In behandeling',
        'closed'      => 'Afgesloten',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::$statuses[$this->status] ?? $this->status;
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::$categories[$this->category] ?? $this->category;
    }
}
