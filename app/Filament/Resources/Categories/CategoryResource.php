<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\ManageCategories;
use App\Models\Category;
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

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';
 
    public static function getModelLabel(): string
    {
        return __('filament-translations::translation.category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-translations::translation.categories');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label(__('filament-translations::translation.name'))
                    ->required(),
                Select::make('parent_id')
                ->label(__('filament-translations::translation.parent'))
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload()
                    ->default(null),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                ->label(__('filament-translations::translation.name')),
                TextEntry::make('parent.name')
                ->label(__('filament-translations::translation.parent'))
                ->default(__('filament-translations::translation.no_parent')),
                TextEntry::make('creator.name')
                ->label(__('filament-translations::translation.creator')),
                TextEntry::make('created_at')
                ->label(__('filament-translations::translation.created_at'))
                ->date('d/m/Y'),
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
                TextColumn::make('parent.name')
                ->label(__('filament-translations::translation.parent'))
                    ->default(__('filament-translations::translation.no_parent'))
                    ->sortable(),
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
            'index' => ManageCategories::route('/'),
        ];
    }
}
