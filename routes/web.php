<?php

declare(strict_types=1);

Route::view('/docs', 'docs');

Route::get('/docs/manifest', static function () {
    $path = resource_path('docs/openapi.json');

    if (!File::exists($path)) {
        abort(404, 'OpenAPI file not found');
    }

    return response(File::get($path));
});
