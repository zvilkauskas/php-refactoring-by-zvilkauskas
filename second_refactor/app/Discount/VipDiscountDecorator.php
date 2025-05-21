<?php

declare(strict_types=1);

namespace App\Discount;

class VipDiscountDecorator implements DiscountStrategy
{
    public function  __construct(private DiscountStrategy $baseStrategy) {}

    public function calculate(float $total): float
    {
        $discount = $this->baseStrategy->calculate($total);

        return ($total - $discount) * 0.9;
    }
}