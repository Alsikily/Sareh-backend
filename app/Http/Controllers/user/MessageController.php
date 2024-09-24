<?php

namespace App\Http\Controllers\user;

// Classes
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Interfaces
use App\Repository\user\message\MessageRepoInterface;

// Requests
use App\Http\Requests\user\MessageRequest;

// Models
use App\Models\Message;

class MessageController extends Controller {

    private $MessageRepo;

    public function __construct(MessageRepoInterface $MessageRepo) {

        $this -> MessageRepo = $MessageRepo;

    }

    public function getUserProfile($user_id) {

        return $this -> MessageRepo -> getUserProfile($user_id);

    }

    public function allMessages() {

        return $this -> MessageRepo -> allMessages();

    }

    public function publicMessages($user_id) {

        return $this -> MessageRepo -> publicMessages($user_id);

    }

    public function favMessages() {

        return $this -> MessageRepo -> favMessages();

    }

    public function store(MessageRequest $request) {

        return $this -> MessageRepo -> store($request);

    }

    public function update($message_id) {

        return $this -> MessageRepo -> update($message_id);

    }

    public function destroy(string $message_id) {

        return $this -> MessageRepo -> delete($message_id);

    }

}
