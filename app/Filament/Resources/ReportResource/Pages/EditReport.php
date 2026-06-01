<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReport extends EditRecord
{
    protected static string $resource = ReportResource::class;

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
