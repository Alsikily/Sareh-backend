<?php

namespace App\Providers\custom;

use Illuminate\Support\ServiceProvider;

use App\Repository\user\message\MessageRepoInterface;
use App\Repository\user\message\MessageRepo;

class MessageProvider extends ServiceProvider {

    public function register(): void {
        $this -> app -> bind(MessageRepoInterface::class, MessageRepo::class);
    }

    public function boot(): void {}

}
