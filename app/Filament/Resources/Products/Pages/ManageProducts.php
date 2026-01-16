<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;

class ManageProducts extends ManageRecords
{
    protected string $view = 'hamza';
    protected static string $resource = ProductResource::class;
    // protected string $view = 'filament.resources.users.pages.list-users';


    

protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User registered')
            ->body('The user has been created successfully.');
    }
    
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                        ->createAnother(false)
//                             ->after(function () {
//   Notification::make()
//             ->success()
//             ->title('Product created')
//             ->body('The product has been created successfully.')
//             ->send();
//     }),
        ];
    }
}
