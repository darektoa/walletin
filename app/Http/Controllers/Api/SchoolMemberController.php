<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
Use App\Http\Resources\MemberResource;
use App\Models\{Member, User};
use Illuminate\Http\Request;

class SchoolMemberController extends Controller
{
    public function index(Request $request) {
        $perPage    = (int) $request->per_page;
        $user       = User::with(['school'])->find(auth()->id());
        $members    = Member::with(['role', 'user'])
            ->where('school_id', $user->school->id)
            ->paginate($perPage);

        return ResponseHelper::paginate(
            MemberResource::collection($members)
        );
    }
}
