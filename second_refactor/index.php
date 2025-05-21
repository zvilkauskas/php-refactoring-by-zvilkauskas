<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use App\Order\OrderProcessor;
use App\Order\TotalCalculator;
use App\Service\EmailService;
use App\Discount\RegularDiscount;
use App\Discount\VipDiscountDecorator;

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
    ],
    [
        'status' => 'pending',
        'customer_email' => 'customer3@example.com',
        'customer_type' => 'regular',
        'items' => [
            ['price' => 48, 'quantity' => 2],
            ['price' => 2, 'quantity' => 1]
        ]
    ],
];

$processor = new OrderProcessor(
    new TotalCalculator(),
    new EmailService()
);

$processor->processOrders($orders);