<?php

class OrderProcessor {
    public function processOrders($orders) {
        foreach ($orders as $order) {
            if ($order['status'] == 'pending') {
                $total = 0;
                foreach ($order['items'] as $item) {
                    $total += $item['price'] * $item['quantity'];
                }
                
                if ($total > 100) {
                    $discount = $total * 0.1;
                } else {
                    $discount = 0;
                }

                $finalTotal = $total - $discount;
                
                if ($order['customer_type'] == 'vip') {
                    $finalTotal *= 0.9;
                }

                $this->sendEmail($order['customer_email'], "Your order total: $" . $finalTotal);
            }
        }
    }

    private function sendEmail($email, $message) {
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
