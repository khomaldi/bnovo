<?php

declare(strict_types=1);

namespace App\Services\Guest;

use Throwable;
use App\Models\Guest;
use App\Dto\GuestDto;
use App\ValueObjects\Phone;

final class GuestService
{
    /**
     * @throws Throwable
     */
    public function create(GuestDto $dto): Guest
    {
        $guest = new Guest();

        $guest->first_name = $dto->getFirstName();
        $guest->last_name = $dto->getLastName();
        $guest->phone = $dto->getPhone();
        $guest->email = $dto->getEmail();
        $guest->country = $dto->getCountry() ?? (new Phone($dto->getPhone()))->getCountry();

        $guest->saveOrFail();

        return $guest;
    }

    /**
     * @throws Throwable
     */
    public function update(Guest $guest, GuestDto $dto): Guest
    {
        foreach (array_filter($dto->toArray()) as $key => $value) {
            $guest->{$key} = $value;
        }

        $guest->saveOrFail();

        return $guest;
    }

    /**
     * @throws Throwable
     */
    public function delete(Guest $guest): void
    {
        $guest->deleteOrFail();
    }
}
