<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;

class ViewCustomerContact extends ViewRecord
{
    protected static string $resource = CustomerResource::class;
    protected static ?string $navigationLabel = 'view Clientes';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function infolist(Schema $schema): Schema
{
    return $schema
        ->components([
                TextEntry::make('name'),
        ]);
}
}
