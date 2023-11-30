<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishValidation extends FormRequest
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
            'restaurant_id' => 'required|exists:restaurants,id,user_id,' . auth()->id(),
            'name' => 'required|min:5|max:30',
            'description' => 'nullable',
            'ingredients' => 'required',
            'visible' => 'required|boolean',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages() : array
    {
        return [
            'restaurant_id.exists' => 'Il ristorante selezionato non appartiene all\'utente corrente.',
            'visible.boolean' => 'Il campo visibile deve essere vero o falso.',
            'price.min' => 'Il prezzo deve essere almeno :min.',
        ];
    }
}
