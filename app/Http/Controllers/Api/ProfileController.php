<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request) {
        $user = User::with(['school', 'member', 'merchant'])
            ->find(auth()->id());

        return ResponseHelper::make(
            UserResource::make($user)
        );
    }
}
