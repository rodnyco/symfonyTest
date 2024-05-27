<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\CreatePurchaseDto;
use App\Payment\PaymentProcessorFactory;
use App\Payment\PaymentProcessorType;
use App\Price\Dto\CalculatePriceDto;
use App\ValueObject\ProductPrice;
use DomainException;

class CreatePurchaseService
{
    public function __construct(
        private readonly CalculatePriceService $calculatePriceService,
        private readonly PaymentProcessorFactory $paymentProcessorFactory,
    ) {}

    public function execute(CreatePurchaseDto $dto): void
    {
        $price = $this->calculatePriceService->execute(new CalculatePriceDto(
            product: $dto->product,
            taxNumber: $dto->taxNumber,
            couponCode: $dto->couponCode,
        ));

        $processor = $this->paymentProcessorFactory->make(PaymentProcessorType::tryFrom($dto->paymentProcessor));

        $isSuccess = $processor->pay(new ProductPrice($price->totalPrice));

        if (!$isSuccess) {
            throw new DomainException('Payment error');
        }
    }
}