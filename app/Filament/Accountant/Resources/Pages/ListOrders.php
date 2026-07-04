<?php

namespace App\Filament\Accountant\Resources\Pages;

use App\Filament\Accountant\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;
}
