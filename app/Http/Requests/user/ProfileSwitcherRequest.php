<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class ProfileSwitcherRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'publish_on_public' => 'required|in:0,1',
            'publish_unknown' => 'required|in:0,1',
        ];
    }

}
