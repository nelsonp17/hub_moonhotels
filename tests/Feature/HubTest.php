<?php

namespace Tests\Feature;

use App\Http\Controllers\HubController;
use App\Http\Controllers\Providers\HotelLegsController;
use App\Http\Requests\HotelLegsRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\MockInterface;
use Tests\TestCase;

class HubTest extends TestCase
{
	// Datos de prueba
	private array $data = [
		'hotelId' => 1,
		'checkIn' => '2018-10-20',
		'checkOut' => '2018-10-25',
		'numberOfGuests' => 3,
		'numberOfRooms' => 2,
		'currency' => 'EUR'
	];
	private string $url = 'api/v1/hub/search';

	/**
	 * Test basic de search.
	 */
	public function test_search(): void
	{
		// Enviar una solicitud POST a la ruta
		$response = $this->postJson($this->url, $this->data);

		$response->assertStatus(200);
	}

	public function test_search_check_response(): void
	{
		// Enviar una solicitud POST a la ruta
		$response = $this->postJson($this->url, $this->data);

		//$response->assertStatus(200);
		// Verificar los datos de la respuesta (si es necesario)
		$response->assertJson([
			'rooms' => [
				'1' => [
					'roomId' => 1,
					'rates' => [
						[
							'mealPlanId' => 1,
							'isCancellable' => null,
							'price' => 123.48
						],
						[
							'mealPlanId' => 1,
							'isCancellable' => 1,
							'price' => 150
						]
					]
				],
				'2' => [
					'roomId' => 2,
					'rates' => [
						[
							'mealPlanId' => 1,
							'isCancellable' => null,
							'price' => 148.25
						],
						[
							'mealPlanId' => 2,
							'isCancellable' => null,
							'price' => 165.38
						]
					]
				]
			]
		]);
	}

	public function test_search_with_mocking()
	{
		// Enviar una solicitud POST a la ruta
		$response = $this->postJson($this->url, $this->data);

		/**$this->mock(HotelLegsController::class, function (MockInterface $mock) {
		 * $mock->shouldReceive('Search')->once()->withAnyArgs()->andReturn(['data' => 'some_data']);
		 * });**/

		/**$this->mock(HubController::class, function (MockInterface $mock) use ($this->data) {
		 * $this->mock->shouldReceive('Search')->once()->withArgs(function ($request) use ($this->data) {
		 * // Verificar que el HotelLegsRequest tenga los datos esperados
		 * $this->assertInstanceOf(HotelLegsRequest::class, $request);
		 * $this->assertEquals($this->data['hotelId'], $request->hotelId);
		 * // ... otras verificaciones
		 *
		 * // Simular la conversión de HubRequest a HotelLegsRequest
		 * $hotelLegsRequest = new HotelLegsRequest($this->data);
		 * return $hotelLegsRequest;
		 * })->andReturnSelf();
		 * });**/

		// Verificar la respuesta
		$response->assertStatus(200);
	}


}
