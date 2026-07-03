<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enums\ProductStatusEnum;
use App\Filament\Tables\CategoriesTable;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\ModalTableSelect;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(fn () => auth()->id()),
                Tabs::make('Product')
                    ->tabs([
                        Tab::make('Basic Information')
                            ->icon('heroicon-o-information-circle')
                            ->columns(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('price')
                                    ->required()
                                    ->prefix('EGP')
                                    ->numeric()
                                    ->columnSpan(1),
                                Radio::make('status')
                                    ->options(ProductStatusEnum::class)
                                    ->required()
                                    ->columnSpan(1)
                                    ->live(),
                                Textarea::make('release_notes')
                                    ->visible(fn (Get $get) => $get('status') === 'coming soon')
                                    ->columnSpan(1),
                                DatePicker::make('release_date')
                                    ->disabled(fn (Get $get) => $get('status') !== 'coming soon')
                                    ->prefix(fn (Get $get) => $get('status') !== 'coming soon' ? 'Coming soon' : '')
                                    ->columnSpan(1),
                            ]),
                        Tab::make('Relationships')
                            ->icon('heroicon-o-link')
                            ->columns(2)
                            ->schema([
                                Section::make('Category')
                                    ->description('Select a category for this product')
                                    ->schema([
                                        ModalTableSelect::make('category_id')
                                            ->relationship('category', 'name')
                                            ->tableConfiguration(CategoriesTable::class),
                                    ])
                                    ->columnSpan(1),
                                Section::make('Tags')
                                    ->description('Attach tags to this product')
                                    ->schema([
                                        Select::make('tags')
                                            ->relationship('tags', 'name')
                                            ->multiple()
                                            ->preload(),
                                    ])
                                    ->columnSpan(1),
                            ]),
                        Tab::make('Settings')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Section::make('Visibility')
                                    ->description('Control product visibility and status')
                                    ->columns(2)
                                    ->schema([
                                        Toggle::make('is_active')
                                            ->label('Active')
                                            ->helperText('Enable to make this product visible'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
