<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Http;

class ApiDataPage extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cloud-arrow-down';

    protected static ?string $navigationLabel = 'External API Data';

    protected static ?string $slug = 'api-data';

    protected static ?string $title = 'External API Data';

    protected static ?int $navigationSort = 2;

    public array $posts = [];

    public function fetchData(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        $this->posts = $response->successful()
            ? $response->json()
            : [];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('fetch')
                ->label('Fetch Data')
                ->icon('heroicon-o-arrow-path')
                ->color('primary')
                ->action('fetchData'),
        ];
    }

    public function getView(): string
    {
        return 'filament.pages.api-data-page';
    }
}
