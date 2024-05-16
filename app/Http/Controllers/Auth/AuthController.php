<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::userToAuthenticate($request->username);

        if (!$user)
            return $this->errorResponse('Unregistered user', Response::HTTP_NOT_FOUND);
        
        if (!Hash::check($request->password, $user->password))
            return $this->errorResponse('Incorrect password', Response::HTTP_NOT_FOUND);
    
        $token = $user->createToken('auth_token')->plainTextToken;

        $data = [
            'message' => 'Successfully authenticated user',
            'user' => array_merge($user->toArray(), [ 
                'role' => count($user->getRoleNames()) > 0 ? $user->getRoleNames()[0] : null, 
                //'permissions' => $user->getAllPermissions() 
            ]),
            'authorization' => [
                'token' => $token,
                'type' => 'Bearer',
            ]
        ];

        return $this->validResponse($data);
    }

    public function userProfile()
    {
        $data = [
            'user' => array_merge(auth()->user()->toArray(), [ 
                'role' => count(auth()->user()->getRoleNames()) > 0 ? auth()->user()->getRoleNames()[0] : null, 
                //'permissions' => auth()->user()->getAllPermissions() 
            ])
        ];

        return $this->validResponse($data);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        
        return $this->validResponse([ 'message' => 'Successfully user logout' ]);
    }
}
