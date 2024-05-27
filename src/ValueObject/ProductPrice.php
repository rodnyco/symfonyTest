<?php

declare(strict_types=1);

namespace App\ValueObject;

class ProductPrice
{
    public function __construct(private readonly float $value)
    {
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function toSmallesUnit(): int
    {
        $res = $this->value * 100;

        return (int) $res;
    }
}