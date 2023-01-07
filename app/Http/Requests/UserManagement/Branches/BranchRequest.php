<?php

namespace App\Http\Requests\UserManagement\Branches;

use App\Constants\Enum;
use App\Models\Branch;
use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
        if($id && \Request::route()->getName() ==  'branches.update'){
            $id = Branch::find($id)->user->id;
        }
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'lat' => 'nullable|string|max:255',
            'lng' => 'nullable|string|max:255',
            'twitter_link' => 'nullable|string|max:255',
            'instagram_link' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'password' => $password_validation,
        ];
    }
    public function messages()
    {
        return [];
    }
}
