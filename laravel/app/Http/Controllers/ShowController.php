<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookSeatsRequest;
use App\Services\ShowService;
use App\Helpers\BaseValidator;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Documentation",
 *      description="Документация для API бронирования мест",
 *      @OA\Contact(
 *          email="support@yourdomain.com"
 *      ),
 * )
 */
class ShowController extends Controller
{
    protected ShowService $showService;
    protected BaseValidator $validator;

    public function __construct(ShowService $showService, BaseValidator $validator)
    {
        $this->showService = $showService;
        $this->validator = $validator;
    }

    /**
     * @OA\Get(
     *     path="/api/shows",
     *     summary="Получить список всех мероприятий",
     *     tags={"Shows"},
     *     @OA\Response(
     *         response=200,
     *         description="Успешный запрос",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Concert"),
     *                 @OA\Property(property="description", type="string", example="A great music concert"),
     *                 @OA\Property(property="date", type="string", format="date", example="2024-08-20"),
     *             )
     *         ),
     *     ),
     * )
     */
    public function index(): array
    {
        return $this->showService->getAllShows();
    }

    /**
     * @OA\Get(
     *     path="/api/shows/{id}/events",
     *     summary="Получить список событий для указанного мероприятия",
     *     tags={"Shows"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID мероприятия",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный запрос",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="show_id", type="integer", example=1),
     *                 @OA\Property(property="date", type="string", format="date-time", example="2024-08-20T19:00:00Z"),
     *                 @OA\Property(property="location", type="string", example="Main Hall"),
     *             )
     *         ),
     *     ),
     * )
     */
    public function showEvents(int $showId): array
    {
        return $this->showService->getShowEvents($showId);
    }

    /**
     * @OA\Get(
     *     path="/api/events/{id}/seats",
     *     summary="Получить доступные места для события",
     *     tags={"Events"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID события",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный запрос",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="seat_id", type="integer", example=101),
     *                 @OA\Property(property="row", type="string", example="A"),
     *                 @OA\Property(property="number", type="integer", example=12),
     *                 @OA\Property(property="available", type="boolean", example=true),
     *             )
     *         ),
     *     ),
     * )
     */
    public function eventSeats(int $eventId): array
    {
        return $this->showService->getEventSeats($eventId);
    }

    /**
     * @OA\Post(
     *     path="/api/events/{id}/book",
     *     summary="Бронирование мест",
     *     tags={"Booking"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID события",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="places", type="array", @OA\Items(type="integer")),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешное бронирование",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Seats booked successfully"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Неверный запрос",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation failed"),
     *         ),
     *     ),
     * )
     */
    public function bookSeats(BookSeatsRequest $request, int $eventId): array
    {
        $places = $request->get('places', []);
        $customerName = $request->input('name');
        return $this->showService->bookSeats($eventId, $places, $customerName);
    }
}
