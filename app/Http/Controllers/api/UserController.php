<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Psy\Util\Str;

class UserController extends APIController
{
    public function store(StoreUserRequest $request){
        try {
            $request->request->add(['password' => Hash::make('secret')]);
            $user = User::create($request->all());
        }catch (\Exception $e){
            return $this->respondWithError(['message' => __('validation.something_went_wrong')]);
        }
        return $this->respondCreated(UserResource::make($user));
    }

    public function authenticateUser(AuthUserRequest $request){
        $user = User::where('phone_number', $request->input('phone_number'))->first();
        if ($user){
            if (!Hash::check($request->input('password'),$user->password)){
                return $this->respondWithUnauthorized(['message' => __('auth.failed')]);
            }else{
                $user->auth_token = \Illuminate\Support\Str::random(32);
                $user->save();
                return $this->respond(['auth_token' => $user->auth_token]);
            }
        }else{
            return $this->respondWithError(['message' => __('validation.something_went_wrong')]);
        }
    }
}
