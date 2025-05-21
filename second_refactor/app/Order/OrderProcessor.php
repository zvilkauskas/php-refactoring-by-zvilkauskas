<?php

declare(strict_types=1);

namespace App\Order;

use App\Discount\RegularDiscount;
use App\Discount\VipDiscountDecorator;
use App\Service\EmailService;

readonly class OrderProcessor
{
    public function __construct(
        private TotalCalculator  $calculator,
        private EmailService     $emailService,
    ) {}

    public function processOrders(array $orders): void
    {
        foreach ($orders as $order) {
            if ($order['status'] !== 'pending') {
                continue;
            }

            $baseDiscount = new RegularDiscount();
            $discountStrategy = $order['customer_type'] === 'vip'
                ? new VipDiscountDecorator($baseDiscount)
                : $baseDiscount;

            $total = $this->calculator->calculate($order['items']);
            $discount = $discountStrategy->calculate($total);
            $finalTotal = $total - $discount;

            $this->emailService->send(
                $order['customer_email'],
                "Your order total: $" . round($finalTotal, 2));
        }
    }
}