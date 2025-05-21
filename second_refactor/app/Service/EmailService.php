<?php

declare(strict_types=1);

namespace App\Service;

class EmailService
{
    public function send(string $email, string $message): void
    {
        echo "Sending email to $email: $message\n";
    }
}