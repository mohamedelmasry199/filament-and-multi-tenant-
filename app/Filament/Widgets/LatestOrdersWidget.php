<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseTableWidget;

class LatestOrdersWidget extends BaseTableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->with(['user', 'product'])
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('User'),
                TextColumn::make('product.name')
                    ->label('Product'),
                TextColumn::make('price')
                    ->money('EGP', 100),
                TextColumn::make('created_at')
                    ->dateTime(),
            ]);
    }
}
