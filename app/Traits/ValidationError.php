<?php

namespace App\Traits;

trait ValidationError {

    public function ValidationError($errors) {

        return response() -> json([
            'status' => "error",
            'errors' => $errors,
            'message' => 'بيانات غير صحيحة',
        ]);

    }

}