<?php

declare(strict_types=1);

namespace App\Discount;

readonly class VipDiscountDecorator implements DiscountStrategy
{
    public function __construct(private DiscountStrategy $baseStrategy) {}

    public function calculate(float $total): float
    {
        $baseDiscount = $this->baseStrategy->calculate($total);
        $afterBaseDiscount = $total - $baseDiscount;
        $vipDiscount = $afterBaseDiscount * 0.1;

        return $baseDiscount + $vipDiscount;
    }
}