<?php

namespace App\Filament\Resources\MeldingResource\Pages;

use App\Filament\Resources\MeldingResource;
use Filament\Resources\Pages\ListRecords;

class ListMeldingen extends ListRecords
{
    protected static string $resource = MeldingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make()->label('Nieuwe melding'),
        ];
    }

    public function getTitle(): string
    {
        return 'Meldingen';
    }
}
