<?php

namespace App\Services;

use App\Repositories\Interfaces\ShowRepositoryInterface;

class ShowService
{
    protected ShowRepositoryInterface $showRepository;

    public function __construct(ShowRepositoryInterface $showRepository)
    {
        $this->showRepository = $showRepository;
    }

    public function getAllShows(): array
    {
        return $this->showRepository->getAllShows();
    }

    public function getShowEvents(int $showId): array
    {
        return $this->showRepository->getShowEvents($showId);
    }

    public function getEventSeats(int $eventId): array
    {
        return $this->showRepository->getEventSeats($eventId);
    }

    public function bookSeats(int $eventId, array $seats, string $customerName): array
    {
        return $this->showRepository->bookSeats($eventId, $seats, $customerName);
    }
}
