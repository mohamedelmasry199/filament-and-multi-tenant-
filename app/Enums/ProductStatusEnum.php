<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;
use Override;

enum ProductStatusEnum: string implements HasColor, HasLabel
{
    case In_Stock = 'in stock';
    case Sold_Out = 'sold out';
    case Out_of_Stock = 'out of stock';
    case Coming_Soon = 'coming soon';

    #[Override]
    public function getLabel(): string|Htmlable|null
    {
        return $this->value;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::In_Stock => 'success',
            self::Out_of_Stock => 'danger',
            self::Sold_Out => 'danger',
            self::Coming_Soon => 'warning',

        };

    }
}
