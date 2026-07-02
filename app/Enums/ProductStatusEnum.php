<?php

namespace App\Enums;

enum ProductStatusEnum: string
{
    case In_Stock = 'in stock';
    case Sold_Out = 'sold out';
    case Out_of_Stock = 'out of stock';
    case Coming_Soon = 'coming soon';
}
