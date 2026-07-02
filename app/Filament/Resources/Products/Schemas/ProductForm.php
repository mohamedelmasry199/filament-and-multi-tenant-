<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enums\ProductStatusEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                           ->required(),
                TextInput::make('price')
                           ->required()
                            ->prefix('EGP')
                            ->numeric(),
                Select::make('status')
                         ->options(ProductStatusEnum::class)
                         ->required(),
                                        // or u can use->rule('numeric'), any rule in laravel use it by this way
            ]);
    }
}
