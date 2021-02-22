<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class storeReadingRequest extends FormRequest
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
            'lastPage' => 'required|numeric',
            'bookId'   => 'required|numeric',
            'date'     => 'required|date',
        ];
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'lastPage.required' => 'Please, insert a page number',
            'lastPage.numeric'  => 'Please, insert a page number',
            'bookId.required'   => 'Please, select a book',
            'bookId.numeric'    => 'Please, select a book',
            'date.date'         => 'Please, insert a date',
        ];
    }
}
