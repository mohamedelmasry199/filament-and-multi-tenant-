<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order Details')
                    ->description('Information about the order')
                    ->columns(2)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
