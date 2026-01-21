<?php

namespace App\Filament\Resources\InstallmentContracts\Pages;

use App\Filament\Resources\InstallmentContracts\InstallmentContractResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use App\Services\InstallmentContractService;
use App\Models\InstallmentContract;

class ManageInstallmentContracts extends ManageRecords
{
    protected static string $resource = InstallmentContractResource::class;
    protected $service;
    public function __construct()
    {
        $this->service = app(InstallmentContractService::class);
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
               ->mutateFormDataUsing(function (array $data) {
                    $data['created_by'] = auth()->id();
                    $data = $this->service->calculateAmounts($data);
                    return $data;
                })
                ->after(function (InstallmentContract $record, array $data) {
                   
                    $this->service->generateInstallments($record, $data);
                    $this->service->updateClientDebt($record->client, $record->total_amount);
                    $this->service->decrementProductStock($record->product);
                }),
        ];
    }


    
}
