<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Request\CalculatePriceRequestDTO;
use App\Exception\InternalException;
use App\Service\Price\PricingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class PriceController extends AbstractController
{

    public function __construct(
        private readonly PricingService $pricingService,
    )
    {
    }

    /**
     * @throws InternalException
     */
    #[Route(path: '/calculate-price', name: 'calculate_price', methods: ['POST'])]
    public function calculatePrice(
        #[MapRequestPayload] CalculatePriceRequestDTO $dto,
    ): JsonResponse
    {
        $finalPrice = $this->pricingService->resolveFinalPrice(
            productId: $dto->productId,
            taxNumber: $dto->taxNumber,
            couponCode: $dto->couponCode,
        );

        return new JsonResponse([
            'finalPrice' => $finalPrice,
        ]);
    }
}