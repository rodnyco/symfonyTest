<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\CalculatePriceResultDto;
use App\Entity\Product;
use App\Price\Dto\CalculatePriceDto;
use App\Repository\CountryTaxRepository;
use App\Repository\CouponRepository;
use App\Repository\ProductRepository;
use App\ValueObject\ProductPrice;
use App\ValueObject\TaxNumber;
use DomainException;

class CalculatePriceService
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly CouponRepository $couponRepository,
        private readonly CountryTaxRepository $countryTaxRepository,
    ) {}

    /**
     * @throws DomainException
     */
    public function execute(CalculatePriceDto $dto): CalculatePriceResultDto
    {
        /** @var ?Product $product */
        $product = $this->productRepository->find($dto->product);

        if ($product === null) {
            throw new DomainException('Product not found.');
        }

        $price = new ProductPrice($product->getPrice());

        $priceWithCoupon = $this->applyCoupon($price, $dto->couponCode);
        $priceWithTax    = $this->applyTax($priceWithCoupon, $dto->taxNumber);

        return new CalculatePriceResultDto(
            price: $price->getValue(),
            priceWithCoupon: $priceWithCoupon->getValue(),
            priceWithTax: $priceWithTax->getValue(),
            totalPrice: $priceWithTax->getValue(),
        );
    }

    /**
     * @throws DomainException
     */
    private function applyCoupon(ProductPrice $price, string $coupon): ProductPrice
    {
        $coupon = $this->couponRepository->findByCode($coupon);

        if ($coupon === null) {
            throw new DomainException('Coupon not found.');
        }

        return $coupon->apply($price);
    }

    /**
     * @throws DomainException
     */
    private function applyTax(ProductPrice $price, string $taxNumber): ProductPrice
    {
        $taxNumber = new TaxNumber($taxNumber);

        $tax = $this->countryTaxRepository->findByCode($taxNumber->extractCountryCode());

        if ($tax === null) {
            throw new DomainException('Country for this tax number not found.');
        }

        return $tax->apply($price);
    }
}