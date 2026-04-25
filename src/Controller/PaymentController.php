<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Request\PurchaseRequestDTO;
use App\Exception\InternalException;
use App\Service\Payment\PaymentProcessorFactory;
use App\Service\Price\PricingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class PaymentController extends AbstractController
{

    public function __construct(
        private readonly PricingService $pricingService,
        private readonly PaymentProcessorFactory $paymentProcessorFactory,
    )
    {
    }

    /**
     * @throws InternalException
     */
    #[Route(path: '/purchase', name: 'purchase', methods: ['POST'])]
    public function purchase(
        #[MapRequestPayload] PurchaseRequestDTO $dto,
    ): JsonResponse
    {
        $finalPrice = $this->pricingService->resolveFinalPrice(
            productId: $dto->productId,
            taxNumber: $dto->taxNumber,
            couponCode: $dto->couponCode,
        );

        $paymentProcessor = $this->paymentProcessorFactory
            ->resolve($dto->paymentProcessor);

        $paymentProcessor->process($finalPrice);

        return new JsonResponse([
            'message' => 'Payment successful',
        ]);
    }
}