<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class StoreComment extends FormRequest
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
            'comment' => [
                'required', 'min:2', 'max:500',
            ],
            'book_id' => [
                'required', 'exists:books,id',
            ],
            'user_id' => [
                'required', 'exists:users,id',
            ],
        ];
    }

    public function messages()
    {
        return [
            'comment.max' => __('comment exceeded maximum of :max characters'),
        ];
    }
}
