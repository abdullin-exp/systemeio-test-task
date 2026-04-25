<?php

declare(strict_types=1);

namespace App\Service\Payment;

use App\Enum\PaymentProcessor;
use App\Exception\InternalException;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

final readonly class StripePaymentAdapter implements PaymentProcessorInterface
{

    public function __construct(
        private StripePaymentProcessor $stripePaymentProcessor,
    )
    {
    }

    public function supports(PaymentProcessor $paymentProcessor): bool
    {
        return $paymentProcessor === PaymentProcessor::STRIPE;
    }

    /**
     * @throws InternalException
     */
    public function process(int $price): void
    {
        $amount = $price / 100;

        $result = $this->stripePaymentProcessor
            ->processPayment($amount);

        if (!$result) {
            throw new InternalException(
                sprintf('Payment failed with type: %s', PaymentProcessor::STRIPE->value),
            );
        }
    }
}