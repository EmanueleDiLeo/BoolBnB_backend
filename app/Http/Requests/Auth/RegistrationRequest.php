<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Carbon\Carbon;



class RegistrationRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'surname' => ['string', 'min:2', 'max:255'],
            'date_birth' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $date_birth = Carbon::parse($value);
                    $currentDate = Carbon::now();
                    $age = $date_birth->diff($currentDate)->y;

                    if ($value > $currentDate) {
                        $fail('Vieni dal futuro?');
                    } elseif ($age < 18) {
                        $fail('Devi essere maggiorenne!');
                    }
                },
            ],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Il nome è un campo obbligatorio.",
            "name.min" => "Il nome deve avere almeno :min caratteri.",
            "name.max" => "Il nome deve avere massimo :max caratteri",
            "surname.min" => "Il cognome deve avere almeno :min caratteri.",
            "surname.max" => "Il cognome deve avere massimo :max caratteri",
            "email.required" => "L'email è un campo obbligatorio.",
            "email.lowercase" => "L'email deve essere scritto in minuscolo.",
            "email.unique" => "L'email è già esistente.",
            "email.max" => "L'email deve avere massimo :max caratteri",
            "email.email" => "L'email deve essera valida",
            "password.required" => "La password è un campo obbligatorio.",
            "password.confirmed" => "La password deve essere uguale.",
            "date_birth.required" => "La data di nascita è un campo obbligatorio."
        ];
    }
}
