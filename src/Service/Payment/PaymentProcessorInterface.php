<?php

declare(strict_types=1);

namespace App\Service\Payment;

use App\Enum\PaymentProcessor;

interface PaymentProcessorInterface
{
    public function supports(PaymentProcessor $paymentProcessor): bool;

    public function process(int $price): void;
}