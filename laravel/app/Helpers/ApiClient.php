<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ApiClient
{
    protected string $baseUrl;
    protected array $headers;

    public function __construct(string $baseUrl, array $headers = [])
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->headers = $headers;
    }

    /**
     * Установить заголовки для запроса.
     *
     * @param array $headers
     * @return void
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * Добавить заголовок к уже существующим.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    protected function get(string $uri, array $params = []): array
    {
        $url = $this->baseUrl;
        if (!empty($uri)) {
            $url .= '/' . ltrim($uri, '/');
        }
        $response = Http::withHeaders($this->headers)->get($url, $params);
        return $response->json();
    }

    protected function post(string $uri, array $data = []): array
    {
        $url = "{$this->baseUrl}/{$uri}";
        $response = Http::withHeaders($this->headers)->post($url, $data);
        return $response->json();
    }

    protected function put(string $uri, array $data = []): array
    {
        $url = "{$this->baseUrl}/{$uri}";
        $response = Http::withHeaders($this->headers)->put($url, $data);
        return $response->json();
    }

    protected function delete(string $uri, array $data = []): array
    {
        $url = "{$this->baseUrl}/{$uri}";
        $response = Http::withHeaders($this->headers)->delete($url, $data);
        return $response->json();
    }
}
