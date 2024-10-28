<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>'required',
            'parent_category_id'=>'required',
            'name'=>'required|string|max:255',
            'type'=>'required|string|in:expense,income',
            'description'=>'string',
        ];
    }

    public function messages():array
    {
        return[
        'user_id.required'=>'user id field is required',
        'name.required'=>'category name is required',
        'type.required'=>'category type is required',
        'parent_category_id.required'=>'parent category id is required'
        ];
    }
}
