<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'category_id' => 'required|numeric|min:0|max:255',
            'user_id'=>'required|integer',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date_from'=>'required|date',
            'date_to'=>'required|date',
            'description' => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required'=>'category id is required',
            'name.required'=>'name is required',
            'amount.required'=>'amount is required',
            'description.required'=>'description is required'
        ];
    }

}
