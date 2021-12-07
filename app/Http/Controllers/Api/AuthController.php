<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request) {
        $registrationData = $request->all();
        $validate = Validator::make($registrationData, [
            'name' => 'required|max:60',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $registrationData['password'] = bcrypt($request->password);
        $user = User::create($registrationData);

        $user->sendEmailVerificationNotification();

        return response([
            'message' => 'Register Success',
            'user' => $user
        ], 200);
        
    }

    public function login(Request $request) {
        $loginData = $request->all();
        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        if(!Auth::attempt($loginData))
            return response(['message' => 'Invalid Credentials'], 401);

        /** @var \App\Models\User $user **/
        $user = Auth::user();

        if($user->email_verified_at == NULL){
            return response(['message' => 'Please Verify Email'], 401);
        }

        $token = $user->createToken('Authentication Token')->accessToken;

        return response([
            'message' => 'Authenticated',
            'user' => $user,
            'token_type' => 'Bearer',
            'access_token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        if($request->user()) {
            /** @var \App\Models\User $user **/
            $user = $request->user();
            
            $user->token()->revoke();

            return response([
                'message' => 'Successfully logged out'
            ]);
        }

        return response([
            'message' => 'Logout failed'
        ]);
    }
}
