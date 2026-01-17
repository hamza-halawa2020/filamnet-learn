<?php

namespace App\Filament\Resources\InstallmentContracts\Pages;

use App\Filament\Resources\InstallmentContracts\InstallmentContractResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageInstallmentContracts extends ManageRecords
{
    protected static string $resource = InstallmentContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
