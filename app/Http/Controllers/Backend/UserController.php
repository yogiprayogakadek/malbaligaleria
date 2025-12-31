<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getUsersWithRelationship(
            ['id', 'name', 'tenant_id', 'email', 'phone', 'status', 'is_active'],
            [
                'tenant:id,name'
            ]
        );

        return view('backend.admin.user.index', compact('users'));
    }
}
