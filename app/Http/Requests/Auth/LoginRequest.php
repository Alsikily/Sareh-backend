<?php

namespace App\Http\Requests\Auth;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

use App\Traits\ValidationError;

class LoginRequest extends FormRequest {

    use ValidationError;

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {

        return [
            "email" => "required|email|exists:users,email",
            "password" => "required"
        ];

    }

    protected function failedValidation(Validator $validator) {

        throw new HttpResponseException($this -> ValidationError($validator->errors()));

    }

}
