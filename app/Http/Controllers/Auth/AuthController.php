<?php

namespace App\Http\Controllers\Auth;

// Classes
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Interfaces
use App\Repository\Auth\AuthRepoInterface;

// Requests
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller {

    private $AuthRepo;

    public function __construct(AuthRepoInterface $AuthRepo) {

        $this -> AuthRepo = $AuthRepo;

    }

    public function login(LoginRequest $request) {

        return $this -> AuthRepo -> login($request);

    }

    public function register(RegisterRequest $request) {

        return $this -> AuthRepo -> register($request);

    }

    public function logout() {

        return $this -> AuthRepo -> logout();

    }

    public function refresh() {

        return $this -> AuthRepo -> refresh();

    }

}
