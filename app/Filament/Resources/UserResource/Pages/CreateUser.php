<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return 'Gebruiker aanmaken';
    }

    protected function afterCreate(): void
    {
        $spatieRole = $this->record->role === 'admin' ? 'admin' : 'melder';
        $this->record->syncRoles([$spatieRole]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
