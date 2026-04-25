<?php

declare(strict_types=1);

namespace App\Service\Payment;

use App\Enum\PaymentProcessor;
use Exception;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

final readonly class PaypalPaymentAdapter implements PaymentProcessorInterface
{

    public function __construct(
        private PaypalPaymentProcessor $paypalPaymentProcessor
    )
    {
    }

    public function supports(PaymentProcessor $paymentProcessor): bool
    {
        return $paymentProcessor === PaymentProcessor::PAYPAL;
    }

    /**
     * @throws Exception
     */
    public function process(int $price): void
    {
        $this->paypalPaymentProcessor->pay($price);
    }
}