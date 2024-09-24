<?php

namespace App\Repository\user\message;

interface MessageRepoInterface {

    public function getUserProfile($user_id);
    public function publicMessages($user_id);
    public function allMessages();
    public function favMessages();
    public function store($request);
    public function update($message_id);
    public function delete($message_id);

}