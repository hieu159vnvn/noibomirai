<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostTagRequest extends FormRequest
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
            'tagName' => 'required',
            'tagSlug' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tagName.required' => 'Tên thẻ là bắt buộc',
            'tagSlug.required'  => 'Slug là bắt buộc',
        ];
    }
}
