<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HubRequest extends FormRequest
{

	/**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hotelId' => 'numeric|required',
			'checkIn' => 'required|date',
			'checkOut' => 'required|date',
			'numberOfGuests' => 'required|numeric',
			'numberOfRooms' => 'required|numeric',
			'currency' => 'required',
        ];
    }

	public function messages(): array
	{
		return [
			'hotelId.required' => 'El campo hotelId es obligatorio.',
			'hotelId.numeric' => 'El campo hotelId debe ser un número.',
			'checkIn.required' => 'El campo checkIn es obligatorio.',
			'checkIn.date' => 'El campo checkIn debe ser una fecha válida.',
			'checkOut.required' => 'El campo checkOut es obligatorio.',
			'checkOut.date' => 'El campo checkOut debe ser una fecha válida.',
			'numberOfGuests.required' => 'El campo numberOfGuests es obligatorio.',
			'numberOfRooms.required' => 'El campo numberOfRooms es obligatorio.',
			'numberOfRooms.numeric' => 'El campo numberOfRooms debe ser un número.',
			'currency.required' => 'El campo currency es obligatorio.',
		];
	}
}
