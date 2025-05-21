<?php

require 'vendor/autoload.php';

use App\Order\TotalCalculator;

$calculator = new TotalCalculator();

$items = [
    ['price' => 10, 'quantity' => 2],
    ['price' => 5, 'quantity' => 3],
];

echo $calculator->calculate($items);