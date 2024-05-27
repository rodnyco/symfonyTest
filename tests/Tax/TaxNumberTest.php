<?php

declare(strict_types=1);

namespace App\Tests\Tax;

use App\ValueObject\TaxNumber;
use DomainException;
use PHPUnit\Framework\TestCase;

class TaxNumberTest extends TestCase
{
    /**
     * @dataProvider validationProvider
     */
    public function testValidation(string $inputNumber, bool $willThrow): void
    {
        if ($willThrow) {
            $this->expectException(DomainException::class);
        }

        $taxNumber = new TaxNumber($inputNumber);
        $this->assertEquals($inputNumber, $taxNumber->getValue());
    }

    /**
     * @dataProvider extractCountryCodeProvider
     */
    public function testExtractCountryCode(string $taxNumber, string $countryCode): void
    {
        $taxNumber = new TaxNumber($taxNumber);

        $this->assertEquals($countryCode, $taxNumber->extractCountryCode());
    }

    public function validationProvider(): array
    {
        return [
            [
                'inputNumber' => 'DE123456789',
                'willThrow' => false,
            ],
            [
                'inputNumber' => 'IT12345678900',
                'willThrow' => false,
            ],
            [
                'inputNumber' => 'FRAB1234567890',
                'willThrow' => false,
            ],
            [
                'inputNumber' => '',
                'willThrow' => true,
            ],
            [
                'inputNumber' => 'FR',
                'willThrow' => true,
            ],
            [
                'inputNumber' => 'FRABDFDFDFD',
                'willThrow' => true,
            ],
        ];
    }

    public function extractCountryCodeProvider(): array
    {
        return [
            [
                'taxNumber' => 'GR123455677',
                'countryCode' => 'GR',
            ],
            [
                'taxNumber' => 'IT12300000000000',
                'countryCode' => 'IT',
            ],
            [
                'taxNumber' => 'GR123456789',
                'countryCode' => 'GR',
            ],
            [
                'taxNumber' => 'FRAB2839298394',
                'countryCode' => 'FR',
            ],
        ];
    }
}