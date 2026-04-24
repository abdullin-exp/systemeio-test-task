<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Request\PurchaseRequestDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class PaymentController extends AbstractController
{
    #[Route(path: '/purchase', name: 'purchase', methods: ['POST'])]
    public function purchase(
        #[MapRequestPayload] PurchaseRequestDTO $requestDTO
    ): JsonResponse
    {
        return new JsonResponse([]);
    }
}