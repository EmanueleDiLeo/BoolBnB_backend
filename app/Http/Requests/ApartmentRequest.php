<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
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
    public function rules()
    {
        return [
            "title" => "required|min:2|max:100",
            "room_number" => "required|numeric|min:1",
            "bed_number" => "required|numeric|min:1",
            "bathroom_number" => "required|numeric|min:1",
            "sq_metres" => "numeric|min:9",
            "city" => "required|min:2|max:255",
            "road" => "required|min:2|max:255",
            "services" => "required"
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Il nome è un campo obbligatorio.",
            "title.min" => "Il titolo deve avere almeno :min caratteri.",
            "title.max" => "Il titolo deve essere massimo :max caratteri",
            "room_number.required" => "Inserisci il numero di stanze.",
            "room_number.numeric" => "Inserisci un valore numerico.",
            "room_number.min" => "Almeno :min stanza deve esserci.",
            "bed_number.required" => "Inserisci il numero di letti a disposizione dell'abitazione.",
            "bed_number.numeric" => "Inserisci un valore numerico.",
            "bed_number.min" => "Almeno :min posto letto deve esserci.",
            "bathroom_number.required" => "Inserisci il numero di bagni a disposizione dell'abitazione.",
            "bathroom_number.numeric" => "Inserisci un valore numerico.",
            "bathroom_number.min" => "Almeno :min bagno deve esserci.",
            "sq_metres.numeric" => "Inserisci un valore numerico.",
            "sq_metres.min" => "ci devono essere almeno :min. mq",
            "img.min" => "L'immagine deve avere almeno :min caratteri.",
            "road.required" => "L'indirizzo è obbligatorio.",
            "road.min" => "L'indirizzo deve avere almeno :max caratteri.",
            "road.max" => "L'indirizzo deve essere massimo :max caratteri.",
            "city.required" => "L'indirizzo è obbligatorio.",
            "city.min" => "L'indirizzo deve avere almeno :max caratteri.",
            "city.max" => "L'indirizzo deve essere massimo :max caratteri.",
            "services.required" => "Devi selezionare almeno un servizio.",
        ];
    }
}
