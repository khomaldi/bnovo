<?php

declare(strict_types=1);

use App\Http\Controllers\GuestController;

Route::prefix('guests')->group(function (): void {
    Route::post('/', [GuestController::class, 'create']);
    Route::get('/{guest?}', [GuestController::class, 'read']);
    Route::patch('/{guest}', [GuestController::class, 'update']);
    Route::delete('/{guest}', [GuestController::class, 'delete']);
});
