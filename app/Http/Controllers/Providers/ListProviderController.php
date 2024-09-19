<?php

namespace App\Http\Controllers\Providers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilsController;
use App\Http\Requests\HubRequest;
use Exception;

class ListProviderController extends Controller
{
	private HotelLegsController $hotelLegsController;

	public function __construct()
	{
		$this->hotelLegsController = new HotelLegsController();
	}

	/**
	 * @throws Exception
	 */
	public function HotelLegs(HubRequest $request, array $response): array
	{
		// crea el request para enviar a la api HotelLegs
		$hotelLegsRequest = $this->hotelLegsController->Setter($request);

		// crea la conexion con la api de HotelLegs
		$hotelLegsResponse = $this->hotelLegsController->Search($hotelLegsRequest);

		if($hotelLegsResponse == null){
			throw new Exception("hotelLegsResponse is null");
		}

		if( empty($hotelLegsResponse['results']) ){
			throw new Exception("hotelLegsResponse results is null");
		}

		// Convertir el formato ResponseHotelLegs a formato HUB
		try {
			// si el response esta vacio lo creo
			if(empty($response)){
				return UtilsController::transformDataHub($hotelLegsResponse['results']);
			}

			// si no lo sobreescribo
			return UtilsController::transformDataOverwrite($response, $hotelLegsResponse['results']);

		}catch (Exception $e){
			throw new Exception($e->getMessage());
		}
	}
}
