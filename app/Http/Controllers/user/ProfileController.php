<?php

namespace App\Http\Controllers\user;

// Classes
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Interfaces
use App\Repository\user\profile\ProfileRepoInterface;

// Requests
use App\Http\Requests\user\ProfilePhotoRequest;
use App\Http\Requests\user\ProfileSwitcherRequest;

class ProfileController extends Controller {

    private $ProfileRepo;

    public function __construct(ProfileRepoInterface $ProfileRepo) {

        $this -> ProfileRepo = $ProfileRepo;

    }

    public function getUserProfile() {

        return $this -> ProfileRepo -> getUserProfile();

    }

    public function getMyProfile() {

        return $this -> ProfileRepo -> getMyProfile();

    }

    public function updateProfile(ProfilePhotoRequest $request) {

        return $this -> ProfileRepo -> updateProfile($request);

    }

    public function updateProfileSwitcher(ProfileSwitcherRequest $request) {

        return $this -> ProfileRepo -> updateProfileSwitcher($request);

    }

}
