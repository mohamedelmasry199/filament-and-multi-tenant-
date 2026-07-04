<?php

use App\Providers\AppServiceProvider;
use App\Providers\Filament\AccountantPanelProvider;
use App\Providers\Filament\AdminPanelProvider;
use App\Providers\FortifyServiceProvider;

return [
    AppServiceProvider::class,
    AccountantPanelProvider::class,
    AdminPanelProvider::class,
    FortifyServiceProvider::class,
];
