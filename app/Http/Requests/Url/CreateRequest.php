<?php

namespace App\Http\Requests\Url;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|url|unique:urls',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Некорректный URL',
            'name.url' => 'Некорректный URL',
        ];
    }
}
