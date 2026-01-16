<?php

namespace App\Filament\Resources\Hamzas;

use App\Filament\Resources\Hamzas\Pages\CreateHamza;
use App\Filament\Resources\Hamzas\Pages\EditHamza;
use App\Filament\Resources\Hamzas\Pages\ListHamzas;
use App\Filament\Resources\Hamzas\Pages\ViewHamza;
use App\Filament\Resources\Hamzas\Schemas\HamzaForm;
use App\Filament\Resources\Hamzas\Schemas\HamzaInfolist;
use App\Filament\Resources\Hamzas\Tables\HamzasTable;
use App\Models\Hamza;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HamzaResource extends Resource
{
    protected static ?string $model = Hamza::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'y';

    public static function form(Schema $schema): Schema
    {
        return HamzaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HamzaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HamzasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHamzas::route('/'),
            'create' => CreateHamza::route('/create'),
            'view' => ViewHamza::route('/{record}'),
            'edit' => EditHamza::route('/{record}/edit'),
        ];
    }
}
