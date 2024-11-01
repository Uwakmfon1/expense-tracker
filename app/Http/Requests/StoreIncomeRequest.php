<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncomeRequest extends FormRequest
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
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:one time,daily,weekly,monthly,yearly',
            'amount' => 'required|numeric|min:0',
            'received_at' => 'required|date',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required'=>'category id is required',
            'name.required'=>'name is required',
            'type.required'=>'type is required',
            'amount.required'=>'amount is required',
            'received_at.required'=>'time for receival is required',
            'description.required'=>'description is required'
        ];
    }
}
