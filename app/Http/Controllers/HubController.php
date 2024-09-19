<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Providers\ListProviderController;
use App\Http\Requests\HubRequest;
use Exception;

class HubController extends Controller
{
	private ListProviderController $listProviderController;
	public function __construct()
	{
		$this->listProviderController = new ListProviderController();
	}
	/**
	 * @throws Exception
	 */
	public function Search(HubRequest $request): \Illuminate\Http\JsonResponse
	{
		$validatedData = $request->validated();

		// Validación adicional
		if ($validatedData['checkIn'] > $validatedData['checkOut']) {
			return response()->json(['error' => 'La fecha de inicio debe ser anterior a la fecha de fin'], 422);
		}

		$response = [];

		// Buscar en los proveedores
		$response = $this->listProviderController->HotelLegs($request, $response);

		//print_r($response);
		// retorna el resultado en formato HUB
		return response()->json($response);

	}



}
