<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
        ];
        $rom_images = count($this->input('rom_images'));
        foreach(range(0, $rom_images) as $index) {
            $rules['rom_images.' . $index] = 'image|mimes:jpeg,bmp,png|';
        }

        return $rules;

    }
}
