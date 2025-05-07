<?php

class OrderProcessor
{
    private const int MINIMUM_AMOUNT = 100;
    private const float REGULAR_DISCOUNT = 0.1;
    private const float VIP_DISCOUNT = 0.9;

    public function processOrders(array $orders): void
    {
        foreach ($orders as $order) {
            if ($this->orderIsPending($order)) {
                $total = $this->calculateTotal($order);
                $discountedTotal = $this->calculateDiscountedTotal($total, $order);

                $this->sendEmail(
                    $this->getCustomerEmail($order),
                    "Your order total: $" . round($discountedTotal, 2)
                );
            }
        }
    }

    private function orderIsPending(array $order): bool
    {
        return $order['status'] === 'pending';
    }

    private function getCustomerEmail(array $order): string
    {
        return $order['customer_email'];
    }

    private function calculateTotal(array $order): float
    {
        $total = 0;

        foreach ($order['items'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }

    private function calculateDiscountedTotal(float $total, array $order): float
    {
        $finalTotal = $total;

        if ($total > self::MINIMUM_AMOUNT) {
            $finalTotal -= $total * self::REGULAR_DISCOUNT;
        }

        if ($order['customer_type'] === 'vip') {
            $finalTotal *= self::VIP_DISCOUNT;
        }

        return $finalTotal;
    }

    private function sendEmail(string $email, string $message): void
    {
        // Simulating email sending
        echo "Sending email to $email: $message\n";
    }
}

$orders = [
    [
        'status' => 'pending',
        'customer_email' => 'customer1@example.com',
        'customer_type' => 'vip',
        'items' => [
            ['price' => 50, 'quantity' => 2],
            ['price' => 30, 'quantity' => 1]
        ]
    ],
    [
        'status' => 'completed',
        'customer_email' => 'customer2@example.com',
        'customer_type' => 'regular',
        'items' => [
            ['price' => 20, 'quantity' => 3]
        ]
    ]
];

$processor = new OrderProcessor();
$processor->processOrders($orders);