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
    ]
];

$isVip = $orders[0]['customer_type'] === 'vip';
$baseDiscount = new RegularDiscount();
$discount = $isVip ? new VipDiscountDecorator($baseDiscount) : $baseDiscount;

$processor = new OrderProcessor(
    new TotalCalculator(),
    $discount,
    new EmailService()
);

$processor->processOrders($orders);