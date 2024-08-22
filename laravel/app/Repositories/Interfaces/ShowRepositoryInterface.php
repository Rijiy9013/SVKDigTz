<?php

namespace App\Repositories\Interfaces;

interface ShowRepositoryInterface
{
    public function getAllShows(): array;
    public function getShowEvents(int $showId): array;
    public function getEventSeats(int $eventId): array;
    public function bookSeats(int $eventId, array $seats, string $customerName): array;
}
