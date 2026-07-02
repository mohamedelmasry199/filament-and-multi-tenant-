<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(isIndividual: true , isGlobal: false),
                TextColumn::make('price')
                            ->sortable()
                            ->money('EGP',100), //dollar sign divide by 100
                        // ==  ->formatStateUsing(fn(int $state): float =>$state/100) //if u need to control data returning,
                TextColumn::make('status'),
                TextColumn::make('category.name')
            ])->defaultSort('name', 'asc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
