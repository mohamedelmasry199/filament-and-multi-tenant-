<?php

namespace App\Filament\Resources\Products\Tables;

use App\Enums\ProductStatusEnum;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(isIndividual: true, isGlobal: false),
                // not prefered other way:
                // TextInputColumn::make('name')->rules(['required', 'max:255','min:3']),
                // ->url(fn(Product $record): string => ProductResource::getUrl('show', ['record' => $record])),
                TextColumn::make('price')
                    ->sortable()
                    ->money('EGP', 100), // dollar sign divide by 100
                // ==  ->formatStateUsing(fn(int $state): float =>$state/100) //if u need to control data returning,
                // TextColumn::make('status')->badge(),
                SelectColumn::make('status')
                    ->searchableOptions()
                    ->options(ProductStatusEnum::class)
                    ->rules(['required']),
                TextColumn::make('category.name'),
                // ->url(fn($record): string => CategoryResource::getUrl('edit', ['record' => $record->category])),
                TextColumn::make('tags.name')->badge(),
                TextColumn::make('created_at')
                    ->since(),
                ToggleColumn::make('is_active'),

            ])->defaultSort('name', 'asc')
            ->filters([
                // Filter::make('in stock')->query(fn(Builder $query): Builder => $query->where('status', ProductStatusEnum::In_Stock)),
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(ProductStatusEnum::class),
                SelectFilter::make('category')->relationship('category', 'name'),
                Filter::make('created_from')->schema([
                    DatePicker::make('created_from'),
                ])->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        );

                }),
                Filter::make('created_untill')->schema([
                    DatePicker::make('created_untill'),
                ])->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_untill'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                }),
            ], layout: FiltersLayout::AboveContent)
            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                    ->authorize('update'),
                DeleteAction::make()
                    ->visible(fn (): bool => auth()->user()?->email === 'admin@gmail.com')
                    ->authorize('delete'),
                Action::make('markFeatured')
                    ->label('Mark as Featured')
                    ->icon('heroicon-o-star')
                    ->color('warning')
                    ->action(function (Product $record) {
                        $record->update(['is_active' => ! $record->is_active]);
                        Notification::make()
                            ->title($record->is_active ? 'Product featured!' : 'Product unfeatured!')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('bulkToggleActive')
                        ->label('Toggle Active Status')
                        ->icon('heroicon-o-check-circle')
                        ->action(function (Collection $records) {
                            $records->each(function (Product $record) {
                                $record->update(['is_active' => ! $record->is_active]);
                            });
                            Notification::make()
                                ->title(count($records).' products updated')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->headerActions([
                Action::make('exportReport')
                    ->label('Export Report')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('info')
                    ->action(function () {
                        Notification::make()
                            ->title('Report exported successfully!')
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
