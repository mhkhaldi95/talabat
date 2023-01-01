<?php

namespace App\Http\Requests\UserManagement\Customers;

use App\Constants\Enum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
        $id = $this->route('id');
        $this->merge(['role' => Enum::CUSTOMER]);
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'gender' => ['nullable','numeric','max:15' , Rule::in([Enum::MALE, Enum::FEMALE])],
            'role' => ['nullable','numeric','max:15' , Rule::in([Enum::CUSTOMER])]
        ];
    }
    public function messages()
    {
        return [];
    }
}
