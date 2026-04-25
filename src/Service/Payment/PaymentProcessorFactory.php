<?php

declare(strict_types=1);

namespace App\Service\Payment;

use App\Enum\PaymentProcessor;
use App\Exception\InternalException;

final readonly class PaymentProcessorFactory
{

    /**
     * @param iterable<PaymentProcessorInterface> $processors
     */
    public function __construct(
        private iterable $processors
    ) {}

    /**
     * @throws InternalException
     */
    public function resolve(
        PaymentProcessor $paymentProcessor
    ): PaymentProcessorInterface {

        foreach ($this->processors as $processor) {
            if ($processor->supports($paymentProcessor)) {
                return $processor;
            }
        }

        throw new InternalException(
            sprintf('Unsupported payment method: %s', $paymentProcessor->value),
        );
    }
}