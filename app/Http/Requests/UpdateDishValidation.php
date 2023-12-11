<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDishValidation extends FormRequest
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
            'name' => 'required|min:5|max:100',
            'description' => 'nullable',
            'ingredients' => 'required|min:3',
            'visible' => 'nullable',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image',

        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => "Il prodotto deve avere un nome",
            'name.min' => "Il prodotto deve essere di almeno :min caratteri",
            'restaurant_id.exists' => 'Il ristorante selezionato non appartiene all\'utente corrente.',
            'visible.boolean' => 'Il campo visibile deve essere vero o falso.',
            'price.min' => 'Il prezzo deve essere almeno :min.',
            'price.decimal' => "Il prezzo è in formato errato",
            'ingredients.required' => 'Devi inserire almeno un ingrediente',
            'ingredients.min' => "Il campo ingredienti deve essere almeno di :min caratteri",
            'image.image' => 'Sono accettati solo file immagini'

        ];
    }
}
