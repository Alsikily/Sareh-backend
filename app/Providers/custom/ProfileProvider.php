<?php

namespace App\Providers\custom;

use Illuminate\Support\ServiceProvider;

use App\Repository\user\profile\ProfileRepoInterface;
use App\Repository\user\profile\ProfileRepo;

class ProfileProvider extends ServiceProvider {

    public function register(): void {
        $this -> app -> bind(ProfileRepoInterface::class, ProfileRepo::class);
    }

    public function boot(): void {}

}
