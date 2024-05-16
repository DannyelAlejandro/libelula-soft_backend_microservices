<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\User;

class UserController extends Controller
{
    function index()
    {
        $this->authorize('users.index');
        $users = User::all();
        
        return $this->validResponse($users);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $user)
    {
        $user = User::find($user);

        return $this->validResponse($user);
    }

    public function update(Request $request, string $user)
    {
        //
    }

    public function destroy(string $user)
    {
        //
    }
}