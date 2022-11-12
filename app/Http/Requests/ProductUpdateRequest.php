<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('store-update-delete-product', Auth::user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'slug' => 'string',
            'price' => 'integer',
            'color_id' => 'array',
            'size_id' => 'array',
            'category_id' => 'array',
            'image' => 'array',
            'image.*' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];
    }
}
