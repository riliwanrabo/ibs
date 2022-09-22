<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class MiscsController extends Controller
{
    /**
     * API information
     * Displays brief information about the API's developemnt/production environment
     *
     * @return JsonResponse
     */
    public function siteInfo(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'app_name' => env('APP_NAME') ?? 'IBS ASSESSMENT ~ Riliwan Balogun',
            'php_version' => PHP_VERSION,
            'app_version' => app()->version(),
            'in_maintainance_mode' => app()->isDownForMaintenance(),
            'message' => 'up and running',
            'timezone' => now()->getTimezone(),
        ]);
    }
}
