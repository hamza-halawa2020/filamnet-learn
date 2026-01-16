<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Operation;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->unique()
                    // ->hiddenOn(Operation::Edit)
                        ->password()

                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('address')
                    ->required(),
            ]);
    }
}
