<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
class UtilsController extends Controller
{
	// Funcion para calcular noches, devulve la diferencia en dias
	public static function CalculateNights($checkIn, $checkOut): int
	{
		// Calculamos la diferencia en días para obtener el número de noches
		return $checkIn->diffInDays($checkOut);
	}

	public static function CalculateNightsString(string $checkIn, string $checkOut): int
	{
		// instancia de Carbon
		$carbon = new Carbon();

		// Convertimos las fechas a objetos DateTime para realizar cálculos
		$checkInDate = Carbon::parse($checkIn);
		$checkOutDate = Carbon::parse($checkOut);

		// Calculamos la diferencia en días para obtener el número de noches
		return $checkInDate->diffInDays($checkOut);
	}

	// Traduce el response del HotelLegs al formato estandar el HUB
	public static function transformDataHub(array $data): array
	{
		$result = [];

		foreach ($data as $item) {
			$roomId = $item['room'];
			$rates = [];

			if (!isset($result[$roomId])) {
				$result[$roomId] = ['roomId' => $roomId, 'rates' => []];
			}

			$result[$roomId]['rates'][] = [
				'mealPlanId' => $item['meal'],
				'isCancellable' => $item['canCancel'],
				'price' => $item['price']
			];
		}

		return ['rooms' => $result];
	}

	// Traduce el response del HotelLegs al formato estandar el HUB y sobreescribe el formato
	public static function transformDataOverwrite($transformedData, $newOriginalData) :array
	{
		foreach ($newOriginalData as $newItem) {
			$roomId = $newItem['room'];
			$rates = [];

			// Buscamos si la habitación ya existe en los datos transformados
			if (isset($transformedData['rooms'][$roomId])) {
				$existingRates = $transformedData['rooms'][$roomId]['rates'];
				$rates = array_merge($existingRates, [
					[
						'mealPlanId' => $newItem['meal'],
						'isCancellable' => $newItem['canCancel'],
						'price' => $newItem['price']
					]
				]);
			} else {
				$rates[] = [
					'mealPlanId' => $newItem['meal'],
					'isCancellable' => $newItem['canCancel'],
					'price' => $newItem['price']
				];
			}

			$transformedData['rooms'][$roomId] = [
				'roomId' => $roomId,
				'rates' => $rates
			];
		}

		return $transformedData;
	}
}
