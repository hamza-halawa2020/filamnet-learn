<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Arr;
use Filament\Actions\Action;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
    // protected static bool $canCreateAnother = false;
// public function canCreateAnother(): bool
// {
//     return false;
// }

protected function preserveFormDataWhenCreatingAnother(array $data): array
{
    return Arr::only($data, ['name']);
}

    protected function getRedirectUrl(): string
    {
        // return $this->getResource()::getUrl('index');
        return $this->previousUrl;

    }

    // protected function getCreatedNotificationTitle(): ?string
    // {
    //     return 'User hamzamzamzmamz';
    // }


    // protected function getCreatedNotification(): ?Notification
    // {
    //     return Notification::make()
    //         ->success()
    //         ->title('User registered')
    //         ->body('The user has been created successfully.');
    // }
protected function beforeCreate(): void
{
    // if (! auth()->user()->team->subscribed()) {
        Notification::make()
            ->warning()
            ->title('You don\'t have an active subscription!')
            ->body('Choose a plan to continue.')
            ->persistent()
            ->actions([
                Action::make('subscribe')
                    ->button()
                    // ->url(route('subscribe'), shouldOpenInNewTab: true)
                    ,
            ])
            ->send();
    
        $this->halt();
    // }
}
    protected function afterCreate(): void
    {
        Notification::make()
            ->success()
            ->title('User created')
            ->body('The user has been created successfully.')
            ->send();
    }
}
