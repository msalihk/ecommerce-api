<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
            return [
                'title' => ['sometimes', 'min:2', 'max:255'],
                'line_1' => ['sometimes'],
                'line_2' => ['sometimes', 'max:255'],
                'phone' => ['sometimes', 'min:10'],
                'postal_code' => ['sometimes', 'min:5']
            ];

    }
}
