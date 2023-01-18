<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {

        $users = User::get();
        return view('auth.all-users', ['users' => $users]);
    }

    public function editUser (Request $req) {

        $userdata = User::findOrFail($req->id);
        return view('auth.edituser', ['user' => $userdata]);
    }

    public function updateUser (Request $request) {
        return $request;
    }

}
