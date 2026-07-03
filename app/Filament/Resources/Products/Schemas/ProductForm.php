<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enums\ProductStatusEnum;
use App\Filament\Tables\CategoriesTable;
use Filament\Forms\Components\ModalTableSelect;
use Filament\Forms\Components\Radio;
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
                    ->numeric(), // or u can use->rule('numeric'), any rule in laravel use it by this way

                Radio::make('status')
                    ->options(ProductStatusEnum::class)
                    ->required(),

                // Select::make('category_id')
                //       ->relationship('category', 'name'),  //category->name of relationship

                ModalTableSelect::make('category_id')
                    ->relationship('category', 'name')
                    ->tableConfiguration(CategoriesTable::class),
                Select::make('tags')
                    ->relationship('tags', 'name')
                    ->multiple(),
            ]);
    }
}
