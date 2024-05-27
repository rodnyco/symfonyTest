<?php

declare(strict_types=1);

namespace App\ValueObject;

use DomainException;

class TaxNumber
{
    private const PATTERN = '/^([A-Z]{2})([A-Z]{2}\d+$|\d+$)/';

    private string $value;

    /**
     * @throws DomainException
     */
    public function __construct(string $value)
    {
        $this->setValue($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function extractCountryCode(): string
    {
        preg_match(self::PATTERN, $this->value, $matches);

        return $matches[1];
    }

    /**
     * @throws DomainException
     */
    private function setValue(string $value): void
    {
        if (!preg_match(self::PATTERN, $value, $matches)) {
            throw new DomainException('Invalid tax number');
        }

        $this->value = $value;
    }
}