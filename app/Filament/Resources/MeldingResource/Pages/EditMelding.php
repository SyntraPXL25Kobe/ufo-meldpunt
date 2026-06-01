<?php

namespace App\Filament\Resources\MeldingResource\Pages;

use App\Filament\Resources\MeldingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMelding extends EditRecord
{
    protected static string $resource = MeldingResource::class;

    public function getTitle(): string
    {
        return 'Melding bewerken';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Verwijderen'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
