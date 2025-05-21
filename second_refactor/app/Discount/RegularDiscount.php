<?php

declare(strict_types=1);

namespace App\Discount;

class RegularDiscount implements DiscountStrategy
{
    public function calculate(float $total): float
    {
        return ($total > 100) ? $total * 0.1 : 0;
    }
}