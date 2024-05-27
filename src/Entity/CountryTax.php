<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CountryTaxRepository;
use App\ValueObject\ProductPrice;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryTaxRepository::class)]
class CountryTax
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $country_code = null;

    #[ORM\Column]
    private ?int $tax_value = null;

    public function apply(ProductPrice $price): ProductPrice
    {
        return new ProductPrice(
            $price->getValue() + ($price->getValue() * ($this->tax_value / 100))
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $countryCode): static
    {
        $this->country_code = $countryCode;

        return $this;
    }

    public function getTaxValue(): ?int
    {
        return $this->tax_value;
    }

    public function setTaxValue(int $taxValue): static
    {
        $this->tax_value = $taxValue;

        return $this;
    }
}
