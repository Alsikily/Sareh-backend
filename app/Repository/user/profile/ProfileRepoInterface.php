<?php

namespace App\Repository\user\profile;

interface ProfileRepoInterface {

    public function getUserProfile();
    public function getMyProfile();
    public function updateProfile($request);
    public function updateProfileSwitcher($request);

}