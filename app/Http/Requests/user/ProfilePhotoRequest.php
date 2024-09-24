<?php

namespace App\Http\Requests\user;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

// Traits
use App\Traits\ValidationError;

class ProfilePhotoRequest extends FormRequest {

    use ValidationError;

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            "photo" => "required|image|mimes:jpg,jpeg,png,bmp"
        ];
    }

    protected function failedValidation(Validator $validator) {

        throw new HttpResponseException($this -> ValidationError($validator->errors()));

    }

}
