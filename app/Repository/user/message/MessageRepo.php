<?php

namespace App\Repository\user\message;

// Classes
use Illuminate\Support\Facades\Auth;

// Interface
use App\Repository\user\message\MessageRepoInterface;

// Models
use App\Models\User;
use App\Models\Message;

class MessageRepo implements MessageRepoInterface {

    public function getUserProfile($user_id) {

        $user_profile = User::where('id', $user_id) -> first();

        if ($user_profile) {

            return response() -> json([
                "status" => "success",
                "user_profile" => $user_profile
            ]);

        }

        return response()->json([
            'status' => 'error',
            'message' => 'الحساب غير موجود',
        ]);

    }

    public function publicMessages($user_id) {

        $user_profile = User::where('id', $user_id) -> first();

        if ($user_profile) {

            $messages = Message::with("user")
                        -> where("user_id", $user_id)
                        -> where("status", 1)
                        -> get();

            return response()->json([
                'status' => 'success',
                'messages' => $messages,
            ]);

        }

        return response()->json([
            'status' => 'error',
            'message' => 'الحساب غير موجود',
        ]);

    }

    public function allMessages() {

        $messages_query = Message::with("user") -> where("user_id", Auth::user() -> id);
        $messages_query -> update([
            'isRead' => 1
        ]);
        $messages = $messages_query -> get();

        return response()->json([
            'status' => 'success',
            'messages' => $messages,
        ]);

    }

    public function favMessages() {

        $messages = Message::with("user")
        -> where("user_id", Auth::user() -> id)
        -> where("fav", "1")
        -> get();

        return response()->json([
            'status' => 'success',
            'messages' => $messages,
        ]);

    }

    public function store($request) {

        $message_created = Message::create($request -> all());

        return response()->json([
            'status' => 'success',
            'message_created' => $message_created,
            'message' => 'تم إضافة الصراحة بنجاح'
        ]);

    }

    public function update($message_id) {

        $message = Message::where("id", $message_id);
        $exist = $message -> first();

        if ($exist) {

            $new_value = $exist -> fav == "0" ? "1" : "0";
            $added = 'تمت اضافة الصراحة الي المفضلة';
            $removed = 'تم حذف الصراحة من المفضلة';
            $message_alert = $new_value == "0" ? $removed : $added;
            $message -> update([ "fav" => $new_value ]);

            return response()->json([
                'status' => 'success',
                'message_updated' => $message -> first(),
                'message' => $message_alert
            ]);

        }

        return response()->json([
            'status' => 'error',
            'message' => 'هذه الصراحة غير موجودة',
        ]);

    }

    public function delete($message_id) {

        $message = Message::where("id", $message_id) -> where('user_id', Auth::user() -> id);
        $exist = $message -> first();

        if ($exist) {

            $message -> delete();

            return response()->json([
                'status' => 'success',
                'message' => 'تم حذف الصراحة بنجاح'
            ]);

        }

        return response()->json([
            'status' => 'error',
            'message' => 'هذه الصراحة غير موجودة',
        ]);

    }

}