<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::count())
                ->description('All products in inventory')
                ->descriptionIcon('heroicon-o-cube')
                ->color('primary'),
            Stat::make('Total Orders', Order::count())
                ->description('All orders placed')
                ->descriptionIcon('heroicon-o-shopping-cart')
                ->color('success'),
            Stat::make('Active Products', Product::where('is_active', true)->count())
                ->description('Currently featured products')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('warning'),
            Stat::make('Total Categories', Category::count())
                ->description('Product categories')
                ->descriptionIcon('heroicon-o-tag')
                ->color('info'),
        ];
    }
}
