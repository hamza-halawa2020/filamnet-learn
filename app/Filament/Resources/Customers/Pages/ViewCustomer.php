<?php

namespace App\Filament\Resources\Customers\Pages;
    use Filament\Resources\Pages\Page;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use App\Filament\Resources\Products\ProductResource;
use App\Models\Product;
class ViewCustomer extends ViewRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        $productId = Product::where('id', 1)->first()->id;

        return [
            EditAction::make(),
            $this->storeCustomer(),

            //  Action::make('showProduct')
            // ->label('Show Product')
            // ->icon('heroicon-o-eye'),
            // ->url(CustomerResource::getUrl('create'))
            // ->url(ProductResource::getUrl('view', ['record' => $productId]))

            // ->url(ProductResource::getUrl('create') . '?customer_id=' . $this->record->id)

            // ->openUrlInNewTab(), 
        ];
    }


    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewCustomer::class,
            EditCustomer::class,
            EditCustomerContact::class,
            ManageCustomerAddresses::class,
            ManageCustomerPayments::class,
        ]);
    }

        protected function storeCustomer(): Action
    {
        return Action::make('storeCustomer')
                ->label('Store Customer')
                ->icon('heroicon-o-plus')
                ->url(CustomerResource::getUrl('create'))
                // ->openUrlInNewTab()
                ; 
    }

}
