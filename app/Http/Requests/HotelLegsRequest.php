<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelLegsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
		return [
			'hotel' => 'numeric|required',
			'checkInDate' => 'required|date',
			'numberOfNights' => 'required|numeric',
			'guests' => 'required|numeric',
			'rooms' => 'required|numeric',
			'currency' => 'required',
		];
    }
	public function messages(): array
	{
		return [
			'hotel.required' => 'El campo hotel es obligatorio.',
			'hotel.numeric' => 'El campo hotel debe ser un número.',
			'checkInDate.required' => 'El campo checkInDate es obligatorio.',
			'checkInDate.date' => 'El campo checkInDate debe ser una fecha válida.',
			'numberOfNights.required' => 'El campo numberOfNights es obligatorio.',
			'numberOfNights.numeric' => 'El campo numberOfNights debe ser un número.',
			'guests.required' => 'El campo guests es obligatorio.',
			'guests.numeric' => 'El campo guests debe ser un número.',
			'rooms.required' => 'El campo rooms es obligatorio.',
			'rooms.numeric' => 'El campo rooms debe ser un número.',
			'currency.required' => 'El campo currency es obligatorio.',
		];
	}
}
