<?php

declare(strict_types=1);

namespace App\Order;

use App\Discount\DiscountStrategy;
use App\Service\EmailService;

class OrderProcessor
{
    public function __construct(
        private TotalCalculator $calculator,
        private DiscountStrategy $discountStrategy,
        private EmailService $emailService,
    ) {}

    public function processOrders(array $orders): void
    {
        foreach ($orders as $order) {
            if ($order['status'] !== 'pending') {
                continue;
            }

            $total = $this->calculator->calculate($order['items']);
            $finalTotal = $this->discountStrategy->calculate($total);

            $this->emailService->send(
                $order['customer_email'],
                "Your order total: $" . round($finalTotal, 2));
        }
    }
}