<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'restaurant-name' => 'required|unique:restaurants,name|min:3|max:100',
            'address' => 'required',
            'piva' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'username' => 'required',
            'photo' => 'nullable|image',
            'types' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'restaurant-name.required' => "Il ristorante deve avere un nome",
            'restaurant.unique' => 'Questo ristorante esiste già sul nostro sito',
            'restaurant-name.min' => "Il nome del ristorante deve essere di almeno :min caratteri",
            'restaurant-name.max' => "Il nome del ristorante non può essere più lungo di :max caratteri",
            'restaurant-name.exists' => 'Il nome del ristorante non può superare i :max caratteri',
            'email.required' => 'Devi inserire un indirizzo email',
            'email.email' => 'Devi inserire un indirizzo email valido',
            'password.required' => 'Devi inserire una password',
            'password.min' => 'Devi una password di almeno :min caratteri',
            'piva.numeric' => 'La partita IVA non può contenere caratteri non numerici',
            'username.required' => "L'username è richiesto",
            'photo.image' => 'Puoi caricare solo file immagini',
            'types.required' => 'Almeno una categoria per il ristorante è richiesto'

        ];
    }
}

