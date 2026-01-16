<?php

namespace App\Filament\Resources\Hamzas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class HamzaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
    TextInput::make('name')
                    ->required(),            ]);
    }
}
