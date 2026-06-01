<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Gebruikers';

    protected static ?string $modelLabel = 'Gebruiker';

    protected static ?string $pluralModelLabel = 'Gebruikers';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Gebruikersgegevens')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Naam')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('E-mailadres')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('role')
                            ->label('Rol')
                            ->options([
                                'reporter' => 'Melder',
                                'admin'    => 'Admin',
                            ])
                            ->required()
                            ->default('reporter'),
                        Forms\Components\TextInput::make('password')
                            ->label('Wachtwoord')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context) => $context === 'create')
                            ->minLength(8),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Naam')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mailadres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Rol')
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'admin'    => 'Admin',
                        'reporter' => 'Melder',
                        default    => $state,
                    })
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'admin' => 'danger',
                        default => 'primary',
                    }),
                Tables\Columns\TextColumn::make('reports_count')
                    ->label('Meldingen')
                    ->counts('reports')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Geregistreerd op')
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Rol')
                    ->options([
                        'reporter' => 'Melder',
                        'admin'    => 'Admin',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Bewerken'),
                Tables\Actions\DeleteAction::make()->label('Verwijderen'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Verwijder geselecteerde'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
