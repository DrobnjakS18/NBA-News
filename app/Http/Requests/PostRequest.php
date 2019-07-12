<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:140|min:3',
            'picture' => 'required|file|mimes:jpg,jpeg,png|max:2000',
            'text' => 'required|min:3',
            'catId' => 'required'
        ];


    }
}
