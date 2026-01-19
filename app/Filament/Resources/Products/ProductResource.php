<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\ManageProducts;
use App\Filament\Resources\Products\Pages\ViewProduct;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModelLabel(): string
    {
        return __('filament-translations::translation.product');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-translations::translation.products');
    }


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('filament-translations::translation.product_name'))
                    ->required(),
                Textarea::make('description')
                    ->label(__('filament-translations::translation.description'))
                    ->columnSpanFull(),
                TextInput::make('purchase_price')
                    ->label(__('filament-translations::translation.purchase_price'))
                    ->numeric(),
                TextInput::make('sale_price')
                    ->label(__('filament-translations::translation.sale_price'))
                    ->numeric(),
                TextInput::make('stock')
                    ->label(__('filament-translations::translation.stock'))
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('code')
                    ->label(__('filament-translations::translation.code')),
                FileUpload::make('image')
                    ->image()
                    ->label(__('filament-translations::translation.image')),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label(__('filament-translations::translation.product_name')),
                TextEntry::make('description')
                    ->label(__('filament-translations::translation.description')),
                TextEntry::make('purchase_price')
                    ->label(__('filament-translations::translation.purchase_price'))
                    ->numeric(),
                TextEntry::make('sale_price')
                    ->label(__('filament-translations::translation.sale_price'))
                    ->numeric(),
                TextEntry::make('stock')
                    ->label(__('filament-translations::translation.stock'))
                    ->numeric(),
                TextEntry::make('creator.name'),
                TextEntry::make('code')
                    ->label(__('filament-translations::translation.code')),
                ImageEntry::make('image')
                    ->label(__('filament-translations::translation.image')),
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
                    ->label(__('filament-translations::translation.product_name'))
                    ->searchable(),
                TextColumn::make('purchase_price')
                    ->label(__('filament-translations::translation.purchase_price'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sale_price')
                    ->label(__('filament-translations::translation.sale_price'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stock')
                    ->label(__('filament-translations::translation.stock'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('creator.name')
                    ->label(__('filament-translations::translation.creator'))
                    ->sortable(),
                    TextColumn::make('description')
                        ->label(__('filament-translations::translation.description'))
                        ->searchable(),
                TextColumn::make('code')
                    ->label(__('filament-translations::translation.code'))
                    ->searchable(),
                ImageColumn::make('image')
                    ->label(__('filament-translations::translation.image')),
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
            'index' => ManageProducts::route('/'),
            'view' => ViewProduct::route('/{record}'),
        ];
    }
}
