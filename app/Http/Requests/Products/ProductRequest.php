<?php

namespace App\Http\Requests\Products;

use App\Constants\Enum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
//        dd($this->all());
        $id = $this->route('id');
        return [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'master_photo' => 'nullable|file',
            'status' => ['nullable',Rule::in([Enum::PUBLISHED, Enum::INACTIVE])],
            'category_id' => ['required','numeric' , 'exists:categories,id'],
            'max_addons' => ['numeric'],
            'product_options' => ['nullable','array'],
            'tags' => ['nullable'],
            'photos' => 'nullable|array',
            'qty' => 'required|array',
            'photos.*' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount_option' => ['nullable','numeric',Rule::in([Enum::NO_DISCOUNT,Enum::DISCOUNT_PERCENTAGE,Enum::DISCOUNT_FIXED])],
            'discounted_price' => ['nullable','numeric'],
            'discounted_percentage' => ['nullable','numeric'],
        ];
    }
    public function messages()
    {
        return [];
    }
}
