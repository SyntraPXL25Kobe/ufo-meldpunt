<?php

namespace App\Models;

/** @deprecated Use \App\Models\Report instead */
class Melding extends Report {}


class Melding extends Model
{
    protected $fillable = [
        'user_id',
        'waarneming_datum',
        'locatie',
        'beschrijving',
        'categorie',
        'foto',
        'status',
    ];

    protected $casts = [
        'waarneming_datum' => 'datetime',
    ];

    public static array $categorieen = [
        'lichten' => 'Mysterieuze lichten',
        'object' => 'Onbekend vliegend object',
        'geluid' => 'Onverklaarbaar geluid',
        'contact' => 'Mogelijk contact',
        'spoor' => 'Fysiek spoor of afdruk',
        'anders' => 'Anders',
    ];

    public static array $statussen = [
        'nieuw' => 'Nieuw',
        'in_behandeling' => 'In behandeling',
        'afgesloten' => 'Afgesloten',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::$statussen[$this->status] ?? $this->status;
    }

    public function getCategorieeLabelAttribute(): string
    {
        return self::$categorieen[$this->categorie] ?? $this->categorie;
    }
}
