<?php

namespace App\Http\Requests\UserManagement\Admins;

use App\Constants\Enum;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $password_validation = $this->route('id') ? 'nullable|min:3|confirmed' : 'required|min:3|confirmed';
        $id = $this->route('id');
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|array',
            'password' => $password_validation,
            'roles.*' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [];
    }
}
