<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EditCustomerContact extends EditRecord
{
    protected static string $resource = CustomerResource::class;
    protected static ?string $navigationLabel = 'Mis Clientes';


    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('phone')->required(),
            ]);
    }

}
