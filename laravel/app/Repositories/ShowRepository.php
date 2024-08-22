<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ShowRepositoryInterface;
use App\Helpers\Interfaces\TicketApiClientInterface;

class ShowRepository implements ShowRepositoryInterface
{
    protected TicketApiClientInterface $apiClient;

    public function __construct(TicketApiClientInterface $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function getAllShows(): array
    {
        return $this->apiClient->getAllShows();
    }

    public function getShowEvents(int $showId): array
    {
        return $this->apiClient->getShowEvents($showId);
    }

    public function getEventSeats(int $eventId): array
    {
        return $this->apiClient->getEventSeats($eventId);
    }

    public function bookSeats(int $eventId, array $seats, string $customerName): array
    {
        return $this->apiClient->bookSeats($eventId, $seats, $customerName);
    }
}
