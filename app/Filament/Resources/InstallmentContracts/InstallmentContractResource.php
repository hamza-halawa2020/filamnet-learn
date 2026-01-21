<?php

namespace App\Filament\Resources\InstallmentContracts;

use App\Filament\Resources\InstallmentContracts\Pages\ManageInstallmentContracts;
use App\Filament\Resources\InstallmentContracts\Pages\ViewInstallmentContract;
use App\Models\InstallmentContract;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InstallmentContractResource extends Resource
{
    protected static ?string $model = InstallmentContract::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // protected static ?string $recordTitleAttribute = 'start_date';

      public static function getModelLabel(): string
    {
        return __('filament-translations::translation.installment_contract');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-translations::translation.installment_contracts');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_price')
                ->label(__('filament-translations::translation.product_price'))
                    ->required()
                    ->numeric(),
                TextInput::make('down_payment')
                ->label(__('filament-translations::translation.down_payment'))
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('installment_count')
                ->label(__('filament-translations::translation.installment_count'))
                    ->required()
                    ->numeric(),
                TextInput::make('interest_rate')
                ->label(__('filament-translations::translation.interest_rate'))
                    ->required()
                    ->numeric()
                    ->default(0.0),
                DatePicker::make('start_date')
                ->label(__('filament-translations::translation.start_date'))
                    ->required(),
                Select::make('client.name')
                ->label(__('filament-translations::translation.client_name'))
                ->getOptionLabelFromRecordUsing(function ($record) {
                    $debt = $record->debt ?? 0;
                    return "{$record->name} - {$debt}";
                })
                ->relationship('client', 'name')
                ->searchable()
                ->preload(),
                Select::make('product.name')
                ->label(__('filament-translations::translation.product_name'))
                ->relationship('product', 'name')
                ->getOptionLabelFromRecordUsing(function ($record) {
                    $price = $record->sale_price ?? 0;
                    return "{$record->name} - {$price}";
                })
                ->searchable()
                ->preload(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('product_price')
                ->label(__('filament-translations::translation.product_price'))
                    ->numeric(),
                TextEntry::make('down_payment')
                ->label(__('filament-translations::translation.down_payment'))
                    ->numeric(),
                TextEntry::make('remaining_amount')
                ->label(__('filament-translations::translation.remaining_amount'))
                    ->numeric(),
                TextEntry::make('installment_count')
                ->label(__('filament-translations::translation.installment_count'))
                    ->numeric(),
                TextEntry::make('interest_rate')
                ->label(__('filament-translations::translation.interest_rate'))
                    ->numeric(),
                TextEntry::make('interest_amount')
                ->label(__('filament-translations::translation.interest_amount'))
                    ->numeric(),
                TextEntry::make('total_amount')
                ->label(__('filament-translations::translation.total_amount'))
                    ->numeric(),
                TextEntry::make('installment_amount')
                ->label(__('filament-translations::translation.installment_amount'))
                    ->numeric(),
                TextEntry::make('start_date')
                ->label(__('filament-translations::translation.start_date'))
                    ->date(),
                TextEntry::make('client_id')
                ->label(__('filament-translations::translation.client_id'))
                    ->numeric(),
                TextEntry::make('product_id')
                ->label(__('filament-translations::translation.product_id'))
                    ->numeric(),
                TextEntry::make('created_by')
                ->label(__('filament-translations::translation.created_by'))
                    ->numeric(),
                TextEntry::make('created_at')
                ->label(__('filament-translations::translation.created_at'))
                    ->dateTime(),
                TextEntry::make('updated_at')
                ->label(__('filament-translations::translation.updated_at'))
                    ->dateTime(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('start_date')
            ->columns([
                TextColumn::make('product_price')
                ->label(__('filament-translations::translation.product_price'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('down_payment')
                ->label(__('filament-translations::translation.down_payment'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('remaining_amount')
                ->label(__('filament-translations::translation.remaining_amount'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('installment_count')
                ->label(__('filament-translations::translation.installment_count'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('interest_rate')
                ->label(__('filament-translations::translation.interest_rate'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('interest_amount')
                ->label(__('filament-translations::translation.interest_amount'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_amount')
                ->label(__('filament-translations::translation.total_amount'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('installment_amount')
                ->label(__('filament-translations::translation.installment_amount'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_date')
                ->label(__('filament-translations::translation.start_date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('client.name')
                ->label(__('filament-translations::translation.client'))
                    ->sortable(),
                TextColumn::make('product.name')
                ->label(__('filament-translations::translation.product'))
                    ->sortable(),
                TextColumn::make('creator.name')
                ->label(__('filament-translations::translation.creator'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                ->label(__('filament-translations::translation.created_at'))
                    ->dateTime()
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
            'index' => ManageInstallmentContracts::route('/'),
            'view' => ViewInstallmentContract::route('/{record}/view'),
        ];
    }
}
