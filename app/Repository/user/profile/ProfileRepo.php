<?php

namespace App\Repository\user\profile;

// Classes
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// Interface
use App\Repository\user\profile\ProfileRepoInterface;

// Models
use App\Models\User;

class ProfileRepo implements ProfileRepoInterface {

    public function getUserProfile() {

        $user = User::withCount('unReadMessages')
                    -> where('id', Auth::user() -> id)
                    -> first();

        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);

    }

    public function getMyProfile() {

        $user = User::withCount(['messages', 'favMessages', 'unReadMessages'])
                    -> where('id', Auth::user() -> id)
                    -> first();

        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);

    }

    public function updateProfile($request) {

        $requestData = $request -> all();
        $photo = Storage::disk('profileUploads') -> put('profileUploads', $requestData['photo']);
        $requestData['photo'] = $photo;
        $user_exist = User::where("id", Auth::user() -> id);
        $user_exist -> update([
            "photo" => $requestData['photo']
        ]);
        $user = $user_exist -> first();

        return response() -> json([
            'status' => 'success',
            'message' => 'تم تحديث الصورة بنجاح',
            'user' => $user
        ]);

    }

    public function updateProfileSwitcher($request) {

        $user_exist = User::where('id', Auth::user() -> id);
        $user_exist -> update($request -> all());
        $user = $user_exist -> get();

        return response() -> json([
            'status' => 'success',
            'message' => 'تم تحديث البيانات بنجاح',
            'user' => $user,
        ]);

    }

}