<?php

namespace App\Filament\Resources\Products\Tables;

use App\Enums\ProductStatusEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                TextColumn::make('category.name'),
                TextColumn::make('tags.name'),

            ])->defaultSort('name', 'asc')
            ->filters([
                // Filter::make('in stock')->query(fn(Builder $query): Builder => $query->where('status', ProductStatusEnum::In_Stock)),
                SelectFilter::make('status')
    ->label('Status')
    ->options(ProductStatusEnum::class),
                SelectFilter::make('category')->relationship('category', 'name'),
                filter::make('created_from')->schema([
                    DatePicker::make('created_from'),
                ])->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        );

                }),
                    filter::make('created_untill')->schema([
                    DatePicker::make('created_untill'),
                ])->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_untill'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                })
            ],layout: FiltersLayout::AboveContent)
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
