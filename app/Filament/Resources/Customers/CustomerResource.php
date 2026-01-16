<?php

namespace App\Filament\Resources\Customers;

use App\Filament\Resources\Customers\Pages\CreateCustomer;
use App\Filament\Resources\Customers\Pages\EditCustomer;
use App\Filament\Resources\Customers\Pages\EditCustomerContact;
use App\Filament\Resources\Customers\Pages\ViewCustomerContact;
use App\Filament\Resources\Customers\Pages\ListCustomers;
use App\Filament\Resources\Customers\Pages\ViewCustomer;
use App\Filament\Resources\Customers\Schemas\CustomerForm;
use App\Filament\Resources\Customers\Schemas\CustomerInfolist;
use App\Filament\Resources\Customers\Tables\CustomersTable;
use App\Models\Customer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;  
use UnitEnum;
use Filament\Resources\Pages\Page;
use Filament\Pages\Enums\SubNavigationPosition;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $modelLabel = 'big customer';

    protected static ?string $pluralModelLabel = 'clientes';

    protected static bool $hasTitleCaseModelLabel = false;

    protected static ?string $navigationLabel = 'Mis Clientes';


    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-user-group';



    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 1;

    protected static string | UnitEnum | null $navigationGroup = 'Shop';

    



    protected static ?string $recordTitleAttribute = 'email';

    public static function form(Schema $schema): Schema
    {
        return CustomerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {

        return CustomerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomers::route('/'),
            'create' => CreateCustomer::route('/create'),
            'view' => ViewCustomer::route('/{record}'),
            'edit' => EditCustomer::route('/{record}/edit'),
            'edit-contact' => EditCustomerContact::route('/{record}/edit/contact'),
            'view-contact' => ViewCustomerContact::route('/{record}/contact'),


        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }



protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

public static function getRecordSubNavigation(Page $page): array
{
    return $page->generateNavigationItems([
        ViewCustomer::class,
        EditCustomer::class,
        EditCustomerContact::class,
        ViewCustomerContact::class,
    
    ]);
}
}
