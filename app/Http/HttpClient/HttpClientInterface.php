<?php

declare(strict_types=1);

namespace App\Http\HttpClient;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

interface HttpClientInterface
{
    public function get(string $url, array $query = []): Response;

    public function post(string $url, array $data = []): Response;

    public function put(string $url, array $data = []): Response;

    public function delete(string $url, array $data = []): Response;
    public function attach(string $name, string $content, string $filePath): PendingRequest;
}
