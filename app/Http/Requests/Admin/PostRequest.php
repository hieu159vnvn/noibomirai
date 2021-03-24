<?php

namespace App\Http\Requests\Admin;

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
            'postTitle' => 'required',
            'postSlug' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'postTitle.required' => 'Tiêu đề bài viết là bắt buộc',
            'postSlug.required'  => 'Slug là bắt buộc',
        ];
    }
}
