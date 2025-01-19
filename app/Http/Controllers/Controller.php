<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;

abstract class Controller
{
    public function handleHttpResponse(
        Response $response,
        ?string $successMessage = null,
        ?array $data = null
    ): RedirectResponse {

        $redirectData = [
            'data' => $data,
            'success' => '',
            'error' => '',
        ];

        if ($response->successful()) {
            $redirectData['success'] = $successMessage;
        } elseif ($response->failed()) {
            $redirectData['error'] = __('httpResponses.' . $response->status());
        }

        return redirect()->back()->with($redirectData);
    }
}
