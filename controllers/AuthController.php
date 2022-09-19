<?php

namespace kncity\controllers;

use kncity\app\Auth;
use kncity\app\Request;

final class AuthController extends BaseController
{
    public function post(Request $request)
    {
        $user = $this->userRepo->findByUsername($request->post("login"));

        if (!$user || !password_verify($request->post("pass"), $user->password_hash)) {
            return [];
        }
        $authToken = Auth::generateAuthToken();
        $this->userRepo->registerToken($user->id, $authToken);

        return [
            "auth_token" => $authToken,
        ];
    }

    public function delete(Request $request): array
    {
        $authToken = $request->get("auth_token");
        $this->userRepo->invalidateToken($authToken);

        return ["auth" => $authToken];
    }
}