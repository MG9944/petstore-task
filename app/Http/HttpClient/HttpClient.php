<?php

namespace App\Http\HttpClient;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class HttpClient implements HttpClientInterface
{
    public function get(string $url): Response
    {
        return Http::get($url);
    }

    public function post(string $url, array $data = []): Response
    {
        return Http::post($url, $data);
    }

    public function put(string $url, array $data = []): Response
    {
        return Http::put($url, $data);
    }

    public function delete(string $url, array $data = []): Response
    {
        return Http::delete($url, $data);
    }

    public function attach(string $name, string $content, string $filePath): PendingRequest
    {
        return Http::attach($name, $content, $filePath);
    }
}
