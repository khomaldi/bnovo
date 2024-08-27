<?php

declare(strict_types=1);

namespace App\Dto;

use Illuminate\Contracts\Support\Arrayable;

final readonly class GuestDto implements Arrayable
{
    use ArrayableTrait;

    public function __construct(
        private ?string $id = null,
        private ?string $first_name = null,
        private ?string $last_name = null,
        private ?string $phone = null,
        private ?string $email = null,
        private ?string $country = null,
    ) {
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }
}
