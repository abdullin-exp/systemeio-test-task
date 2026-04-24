<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Request\CalculatePriceRequestDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class PriceController extends AbstractController
{
    #[Route(path: '/calculate-price', name: 'calculate_price', methods: ['POST'])]
    public function calculatePrice(
        #[MapRequestPayload] CalculatePriceRequestDTO $requestDTO
    ): JsonResponse
    {
        return new JsonResponse([]);
    }
}