<?php

namespace App\Filament\Resources\Hamzas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HamzaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
            ]);
    }
}
