<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoryRequest extends FormRequest
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
            'categoryName' => 'required',
            'categorySlug' => 'required',
            'categoryParent' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'categoryName.required' => 'Tên chuyên mục là bắt buộc',
            'categorySlug.required'  => 'Slug là bắt buộc',
            'categoryParent.required'  => 'Chuyên mục cha là bắt buộc',
        ];
    }
}
