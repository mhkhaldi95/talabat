<?php

namespace App\Http\Requests\Coupons;

use App\Constants\Enum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|unique:coupons,code,'.$id,
            'max_uses' => 'required',
            'days' => 'required',
            'type' => 'required',
            'discount' => 'required',
        ];
    }
    public function messages()
    {
        return [];
    }
}
