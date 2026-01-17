<?php

namespace App\Filament\Resources\InstallmentContracts\Pages;

use App\Filament\Resources\InstallmentContracts\InstallmentContractResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInstallmentContract extends ViewRecord
{
    protected static string $resource = InstallmentContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
