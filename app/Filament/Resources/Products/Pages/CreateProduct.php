<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    //if u want to change the column created by user
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['price'] = $data['price'] * 100;
        return $data;
    } //now the price in database be * 100 of actual price user entered
}
