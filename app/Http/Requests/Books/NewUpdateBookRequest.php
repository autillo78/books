<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class NewUpdateBookRequest extends FormRequest
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
            'title' => 'required | max:255',
            'pages' => 'nullable|numeric',
            'format_id' => 'required|numeric',
            'type_id' => 'required|numeric',
            'language_code' => 'required|string|max:3'
        ];
    }


    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Title is needed',
            'title.max' => 'Title must be shorter than 255 characters',
            'pages.number' => 'Pages must be a number',
            'format_id.required' => 'Format is needed',
            'format_id.numeric' => 'Format is needed',
            'type_id.required' => 'Type is needed',
            'type_id.numeric' => 'Type is needed',
        ];
    }
}
