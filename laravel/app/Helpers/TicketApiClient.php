<?php

namespace App\Helpers;

use App\Helpers\Interfaces\TicketApiClientInterface;
use Illuminate\Support\Facades\Http;

class TicketApiClient extends ApiClient implements TicketApiClientInterface
{
    public function __construct()
    {
        $baseUrl = config('show_api.url');
        $headers = [
            'Authorization' => 'Bearer ' . config('show_api.token'),
        ];

        parent::__construct($baseUrl, $headers);
    }

    public function getAllShows(): array
    {
        return $this->get('/shows');
    }

    public function getShowEvents(int $showId): array
    {
        return $this->get("shows/{$showId}/events");
    }

    public function getEventSeats(int $eventId): array
    {
        return $this->get("events/{$eventId}/places");
    }

    public function bookSeats(int $eventId, array $seats, string $customerName): array
    {
        return Http::asForm()
        ->withHeaders($this->headers)
        ->post("{$this->baseUrl}/events/{$eventId}/reserve", [
            'places' => $seats,
            'name' => $customerName,
        ])->json();
    }
}
