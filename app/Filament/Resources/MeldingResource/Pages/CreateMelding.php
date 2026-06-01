<?php

namespace App\Filament\Resources\MeldingResource\Pages;

use App\Filament\Resources\MeldingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMelding extends CreateRecord
{
    protected static string $resource = MeldingResource::class;

    public function getTitle(): string
    {
        return 'Melding aanmaken';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
