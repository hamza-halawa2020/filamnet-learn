<?php

namespace App\Filament\Resources\Hamzas\Pages;

use App\Filament\Resources\Hamzas\HamzaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHamza extends ViewRecord
{
    protected static string $resource = HamzaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
