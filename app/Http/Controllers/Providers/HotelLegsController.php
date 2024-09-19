<?php

namespace App\Http\Controllers\Providers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilsController;
use App\Http\Requests\HotelLegsRequest;
use App\Http\Requests\HubRequest;

class HotelLegsController extends Controller
{
	// crear un Setter de HotelLegsRequest
	public static function Setter(HubRequest $request): HotelLegsRequest
	{
		// Crear un HotelLegsRequest a partir de HubRequest
		return new HotelLegsRequest([
			'hotel' => $request->input('hotelId'),
			'checkInDate' => $request->date('checkInDate'),
			'numberOfNights' => UtilsController::CalculateNights(
				$request->date('checkIn'),
				$request->date('checkOut')
			),
			'guests' => $request->input('guests'),
			'rooms' => $request->input('rooms'),
			'currency' => $request->input('currency'),
		]);
		/**return new HotelLegsRequest(
			$request->getHotelId(),
			$request->getCheckIn(),
			UtilsController::CalculateNights($request->getCheckIn(), $request->getCheckOut()),
			$request->getNumberOfGuests(),
			$request->getNumberOfRooms(),
			$request->getCurrency(),
		);**/
	}

	// funcion que conecta con la api de HotelLegs
	public function Search(HotelLegsRequest $request): array
	{
		// aqui se usa el $request para la solicitud a la api HotelLegs

		// Devuelve un ejemplo del resultado de la solicitud
		return $this->getExampleResult();
	}

	private function getExampleResult() : array
	{
		$jsonData = '{
			"results": [
				{
					"room": 1,
					"meal": 1,
					"canCancel": false,
					"price": 123.48
				},
				{
					"room": 1,
					"meal": 1,
					"canCancel": true,
					"price": 150.00
				},
				{
					"room": 2,
					"meal": 1,
					"canCancel": false,
					"price": 148.25
				},
				{
					"room": 2,
					"meal": 2,
					"canCancel": false,
					"price": 165.38

				}
			]
		}';

		// Convierte el JSON a un array asociativo de PHP
		$jsonDecode =  json_decode($jsonData, true);

		//print_r($jsonDecode);
		return $jsonDecode;
	}

}
