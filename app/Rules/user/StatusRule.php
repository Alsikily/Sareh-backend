<?php

namespace App\Rules\user;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

// Models
use App\Models\User;

class StatusRule implements ValidationRule {

    public function validate(string $attribute, mixed $value, Closure $fail): void {

        $user = User::where('id', request() -> user_id) -> first();
        $fail_message = 'Invalid :attribute';

        if (!$user) {

            $fail($fail_message);

        } else {

            $array_in = $user -> publish_on_public == 0 ? [0] : [0, 1];
            if (!in_array($value, $array_in)) {

                $fail($fail_message);

            }

        }

    }

}
