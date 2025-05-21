<?php

declare(strict_types=1);

namespace App\Order;

class TotalCalculator
{
    public function calculate(array $items): float
    {
        $total = 0;

        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}