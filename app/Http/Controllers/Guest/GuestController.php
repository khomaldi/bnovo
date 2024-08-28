<?php

declare(strict_types=1);

namespace App\Http\Controllers\Guest;

use Throwable;
use App\Models\Guest;
use App\Dto\GuestDto;
use Illuminate\Http\JsonResponse;
use App\Services\Guest\GuestService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Guest\Resources\GuestResource;
use App\Http\Controllers\Guest\Requests\CreateGuestRequest;
use App\Http\Controllers\Guest\Requests\UpdateGuestRequest;

final class GuestController extends Controller
{
    public function __construct(private readonly GuestService $service)
    {
    }

    /**
     * @throws Throwable
     */
    public function create(CreateGuestRequest $request): JsonResponse
    {
        $dto = new GuestDto(
            first_name: $request->firstName(),
            last_name: $request->lastName(),
            phone: $request->phone(),
            email: $request->email(),
            country: $request->country(),
        );

        return response()->json(
            data: new GuestResource($this->service->create($dto)),
            status: Response::HTTP_CREATED
        );
    }

    public function read(Guest $guest): JsonResponse
    {
        return response()->json(
            null !== $guest->id
                ? new GuestResource($guest)
                : GuestResource::collection(Guest::all())
        );
    }

    /**
     * @throws Throwable
     */
    public function update(UpdateGuestRequest $request, Guest $guest): JsonResponse
    {
        $dto = new GuestDto(
            first_name: $request->firstName(),
            last_name: $request->lastName(),
            phone: $request->phone(),
            email: $request->email(),
            country: $request->country(),
        );

        return response()->json(new GuestResource($this->service->update($guest, $dto)));
    }

    /**
     * @throws Throwable
     */
    public function delete(Guest $guest): JsonResponse
    {
        $this->service->delete($guest);

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
