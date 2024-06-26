<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function json(string $message = null, $data = [], $statusCode = 200, array $headers = [], $options = JSON_PRESERVE_ZERO_FRACTION)
    {
        $content = [];
        if ($message) {
            $content['message'] = $message;
        }
        if (!empty($data)) {
            $content['data'] = $data;
        }
        return response()->json($content, $statusCode, $headers, $options);
    }
    protected function shop()
    {
        $user = auth()->user();
        $mainShop = $user->shopUser->first();
        return match ($mainShop) {
            null => $user->shop,
            default => $mainShop
        };
    }
}
