<?php

declare(strict_types=1);

namespace App\Discount;

interface DiscountStrategy
{
    public function calculate(float $total): float;
}