<?php

declare(strict_types=1);

namespace App\ValueObjects;

use Stringable;
use Propaganistas\LaravelPhone\PhoneNumber;

final readonly class Phone implements Stringable
{
    private PhoneNumber $phoneNumber;

    public function __construct(private string $phone)
    {
        $this->phoneNumber = new PhoneNumber($this->phone);
    }

    public function getCountry(): ?string
    {
        return $this->phoneNumber->getCountry();
    }

    public function __toString(): string
    {
        return $this->phoneNumber->formatE164();
    }
}
