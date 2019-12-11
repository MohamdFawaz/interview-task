<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Hash;

class UserController extends APIController
{
    public function store(StoreUserRequest $request){
        try {
            $request->request->add(['password' => Hash::make('secret')]);
            $user = User::create($request->all());
        }catch (\Exception $e){
            return $this->respondWithError(__('validation.something_went_wrong'));
        }
        return $this->respondCreated(UserResource::make($user));
    }
}
