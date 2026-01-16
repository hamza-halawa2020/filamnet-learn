<?php

namespace App\Filament\Resources\Hamzas\Pages;

use App\Filament\Resources\Hamzas\HamzaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditHamza extends EditRecord
{
    protected static string $resource = HamzaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }


protected function getSavedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('User updated')
        ->body('The user has been saved successfully.');
}
}
