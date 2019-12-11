<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\ActivateUserRequest;
use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserStatusResource;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Psy\Util\Str;

/**
 * @group User
 *
 * APIs for managing user
 */
class UserController extends APIController
{
    /**
     * Create a user account
     *
     * @bodyParam first_name string required User first name. Example: ali
     * @bodyParam last_name string required User last name. Example: ahmed
     * @bodyParam country_code string required Country Code. Example: EG
     * @bodyParam phone_number string required User phone. Example: 01011111111
     * @bodyParam gender string required User gender. Example: male
     * @bodyParam birthdate string required User birth date. Example: 1999-03-01
     * @bodyParam avatar file required User profile picture.
     * @bodyParam email file required User email address. Example: mail@mail.com
     *
     * @response {
     *  "id": 1,
     *  "first_name": "Ahmed",
     *  "last_name": "Ali",
     *  "country_code": "EG",
     *  "phone_number": "01011111111",
     *  "gender": "male",
     *  "birthdate": "1999-03-01"
     * }
     *
     * @response 404 {
     *  "message": "Sorry Something Went Wrong, Please Try Again Later"
     * }
     */
    public function store(StoreUserRequest $request){
        try {
            $request->request->add(['password' => Hash::make('secret')]);
            $user = User::create($request->all());
        }catch (\Exception $e){
            return $this->respondWithError(['message' => __('validation.something_went_wrong')]);
        }
        return $this->respondCreated(UserResource::make($user));
    }

     /**
      * Authenticate User
      *
      * @bodyParam phone_number string required User phone number. Example: 01011111111
      * @bodyParam password string required User last name. Example: secret
      *
      * @response {
      *   "auth_token": "h6unBUTRAWCBihdPxxF6wleQPyrdqnPv"
      * }
      *
      * @response 404 {
      *  "message": "Sorry Something Went Wrong, Please Try Again Later"
      * }
      */
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

    /**
     * Activate User Status
     *
     * @bodyParam phone_number string required User phone number. Example: 01011111111
     * @bodyParam auth-token string required User token. Example: h6unBUTRAWCBihdPxxF6wleQPyrdqnPv
     * @bodyParam activated integer required User status. Example: 1
     *
     * @response {
     *  "id": 1,
     *  "first_name": "Ahmed",
     *  "last_name": "Ali",
     *  "country_code": "EG",
     *  "phone_number": "01011111111",
     *  "gender": "male",
     *  "birthdate": "1999-10-24",
     *  "status": [
     *   {
     *   "id": 1,
     *   "activated": 0,
     *   "user_id": 1
     *  }
     *  ]
     *  }
     *
     * @response 404 {
     *  "message": "These credentials do not match our records."
     * }
     */
    public function activateUser(ActivateUserRequest $request){
        $user = User::where('phone_number',$request->input('phone_number'))->where('auth_token',$request->input('auth-token'))->first();

        if ($user){
            $user->status()->create(['activated' => $request->input('status')]);
            return $this->respondCreated(UserStatusResource::make($user));
        }else{
            return $this->respondWithError(['message' => __('auth.failed')]);
        }
    }
}
