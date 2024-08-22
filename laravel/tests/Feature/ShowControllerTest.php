<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Repositories\Interfaces\ShowRepositoryInterface;
use Mockery;

class ShowControllerTest extends TestCase
{
    public function testBookSeats(): void
    {
        $mockApiClient = Mockery::mock(ShowRepositoryInterface::class);

        $mockApiClient->shouldReceive('bookSeats')
            ->once()
            ->with(3, [1, 2], 'testing')
            ->andReturn([
                'success' => true,
            ]);

        // Замена реального репозитория на мок
        $this->app->instance(ShowRepositoryInterface::class, $mockApiClient);

        $response = $this->postJson('/api/events/3/book', [
            'name' => 'testing',
            'places' => [1, 2],
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
