<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\CreatePurchaseDto;
use App\Price\Dto\CalculatePriceDto;
use App\Service\CalculatePriceService;
use App\Service\CreatePurchaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class OrderController extends AbstractController
{
    #[Route('/calculate-price', methods: ['POST'])]
    public function calculatePrice(
        #[MapRequestPayload] CalculatePriceDto $dto,
        CalculatePriceService $service
    ): JsonResponse
    {
        return $this->json($service->execute($dto));
    }

    #[Route('/purchase', methods: ['POST'])]
    public function purchase(
        #[MapRequestPayload] CreatePurchaseDto $dto,
        CreatePurchaseService $service
    ): JsonResponse
    {
        $service->execute($dto);

        return $this->json([
            'success' => true,
        ]);
    }
}