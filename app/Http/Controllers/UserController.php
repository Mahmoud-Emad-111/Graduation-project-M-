<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use App\Traits\BaseFunctionsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use BaseFunctionsTrait;
    //
############################### REGISTER  USER  ##########################

    public function Register(UserRequest $request){
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'address'=>$request->address,
            'password'=>Hash::make($request->password),
        ]);

        $res=[
           'Token'=> $user->createToken($user->email)->plainTextToken,
        //    'ID'=>$user->id,
        ];
        return $this->handelResponse($res,'register successfully');
    }
############################### LOGIN  USER ##########################
    public function Login(Request $request){
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $response = [
                'name' => $user->name,
                // 'ID'=>$user->id,
                'token' => $user->createToken($user->email)->plainTextToken,
            ];
            return $this->handelResponse($response, 'login successfully');
        } else {
            return response()->json(['error' => 'unauthorized'], 401);
        }
    }
############################### LOGOUT  USER ##########################

    public function logout()
    {
        auth('sanctum')->user()->tokens()->delete();
        return response()->json([
            'message' => 'Completely logout successfully',

        ]);
    }
############################### Get all user information ##########################
    public function ProfileUser()
    {
        $data= auth('sanctum')->user();
        return UserProfileResource::make($data)->resolve();
    }

############################### Get all users ##########################
    public function Get_All_Users(){
        return UserProfileResource::collection($this->Get(User::class))->resolve();
    }

}
