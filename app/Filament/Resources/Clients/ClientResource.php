<?php

namespace App\Filament\Resources\Clients;

use App\Filament\Resources\Clients\Pages\ManageClients;
use App\Filament\Resources\Clients\Pages\ViewClient;
use App\Models\Client;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModelLabel(): string
    {
        return __('filament-translations::translation.client');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-translations::translation.clients');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label(__('filament-translations::translation.name'))
                    ->required(),
                TextInput::make('phone_number')
                ->label(__('filament-translations::translation.phone_number'))
                    ->tel(),
                TextInput::make('debt')
                ->label(__('filament-translations::translation.debt'))
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('type')
                ->label(__('filament-translations::translation.type'))
                    ->options(['client' => __('filament-translations::translation.client'), 'merchant' => __('filament-translations::translation.merchant')])
                    ->default('client')
                    ->required(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                ->label(__('filament-translations::translation.name')),
                TextEntry::make('phone_number')
                ->label(__('filament-translations::translation.phone_number')),
                TextEntry::make('debt')
                ->label(__('filament-translations::translation.debt'))
                    ->numeric(),
                TextEntry::make('type')
                ->label(__('filament-translations::translation.type')),
                TextEntry::make('creator.name')
                ->label(__('filament-translations::translation.creator')),
                TextEntry::make('created_at')
                ->label(__('filament-translations::translation.created_at'))
                    ->date('d-m-Y'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                ->label(__('filament-translations::translation.name'))
                ->searchable(),
                TextColumn::make('phone_number')
                ->label(__('filament-translations::translation.phone_number'))
                    ->searchable(),
                TextColumn::make('debt')
                ->label(__('filament-translations::translation.debt'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type')
                ->label(__('filament-translations::translation.type')),
                TextColumn::make('creator.name')
                ->label(__('filament-translations::translation.creator'))
                    ->sortable(),
                TextColumn::make('created_at')
                ->label(__('filament-translations::translation.created_at'))
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                ->label(__('filament-translations::translation.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageClients::route('/'),
            'view' => ViewClient::route('/{record}/view'), 
        ];
    }
}
