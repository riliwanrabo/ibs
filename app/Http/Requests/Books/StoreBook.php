<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class StoreBook extends FormRequest
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
            'name' => ['required', 'unique:books,name'],
            'isbn' => ['required', 'unique:books,isbn'],
            'authors' => ['array'],
            'authors.*' => ['required', 'exists:authors,id'],
            'number_of_pages' => ['required', 'integer'],
            'release_date' => ['required', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'authors.*.exists' => 'The author at position :position does not exist',
        ];
    }
}
