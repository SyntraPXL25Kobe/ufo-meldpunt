<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Report;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Actions;
use Filament\Tables;
use Filament\Tables\Table;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-exclamation-triangle';

    protected static ?string $navigationLabel = 'Meldingen';

    protected static ?string $modelLabel = 'Melding';

    protected static ?string $pluralModelLabel = 'Meldingen';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Melding details')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Ingediend door')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->nullable(),
                        Forms\Components\DateTimePicker::make('observed_at')
                            ->label('Datum & tijd waarneming')
                            ->required(),
                        Forms\Components\TextInput::make('location')
                            ->label('Locatie')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Beschrijving')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\Select::make('category')
                            ->label('Categorie')
                            ->options(Report::$categories)
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options(Report::$statuses)
                            ->required()
                            ->default('new'),
                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('reports')
                            ->nullable()
                            ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('observed_at')
                    ->label('Datum waarneming')
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Locatie')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Categorie')
                    ->formatStateUsing(fn (string $state) => Report::$categories[$state] ?? $state)
                    ->badge(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Melder')
                    ->default('Gast')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state) => Report::$statuses[$state] ?? $state)
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new'         => 'warning',
                        'in_progress' => 'info',
                        'closed'      => 'success',
                        default       => 'gray',
                    }),
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(null),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ingediend op')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(Report::$statuses),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Categorie')
                    ->options(Report::$categories),
            ])
            ->actions([
                Actions\EditAction::make()->label('Bewerken'),
                Actions\DeleteAction::make()->label('Verwijderen'),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make()->label('Verwijder geselecteerde'),
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
            'index'  => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit'   => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
