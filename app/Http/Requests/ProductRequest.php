<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'price'=> 'required|numeric|min:1',
            'upc'=> 'required',
            'status'=> 'in:active,inactive',
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ];
    }
}
