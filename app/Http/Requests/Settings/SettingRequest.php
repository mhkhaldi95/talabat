<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'site_name_ar' => 'nullable|string|max:255',
            'site_name_en' => 'nullable|string|max:255',
            'site_description_ar' => 'nullable|string',
            'site_description_en' => 'nullable|string',
            'done_by_ar' => 'nullable|string|max:255',
            'done_by_en' => 'nullable|string|max:255',
            'facebook_link' => 'nullable|string',
            'twitter_link' => 'nullable|string',
            'instagram_link' => 'nullable|string',
            'site_icon' => 'nullable|file',
            'tags' => 'nullable',
        ];
    }
    public function messages()
    {
        return [];
    }
}
