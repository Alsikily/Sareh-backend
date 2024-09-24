<?php

namespace App\Http\Requests\user;

// Classes
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

// Rules
use App\Rules\user\StatusRule;

// Traits
use App\Traits\ValidationError;

class MessageRequest extends FormRequest {

    use ValidationError;

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            "body" => "required|max:5000",
            "user_id" => "required|exists:users,id|bail",
            "sender_id" => "sometimes|nullable|exists:users,id",
            "status" => [
                'required',
                new StatusRule
            ],
        ];
    }

    protected function failedValidation(Validator $validator) {

        throw new HttpResponseException($this -> ValidationError($validator->errors()));

    }

}
