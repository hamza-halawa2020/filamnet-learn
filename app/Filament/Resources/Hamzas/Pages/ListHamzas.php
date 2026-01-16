<?php

namespace App\Filament\Resources\Hamzas\Pages;

use App\Filament\Resources\Hamzas\HamzaResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Imports\HamzaImporter;
use Filament\Actions;

class ListHamzas extends ListRecords
{
    protected static string $resource = HamzaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->importer(HamzaImporter::class),
            CreateAction::make(),
        ];
    }
}
