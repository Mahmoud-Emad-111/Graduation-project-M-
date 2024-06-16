<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResources;
use App\Models\Doctor;
use App\Traits\SaveImagesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    use SaveImagesTrait;
    //
    public function Register(DoctorRequest $request){
        $image=$this->saveImage($request->image,'Doctors_Images');
       $Doctor= Doctor::create([
            'name'=>$request->name,
            'image'=>$image,
            'email'=>$request->email,
            'address'=>$request->address,
            'fees'=> $request->fees,
            'doctor_category_id'=>$request->doctor_category_id,
            'password'=>Hash::make($request->password),

        ]);
        $res=[
            'Token'=> $Doctor->createToken($Doctor->email)->plainTextToken,
         //    'ID'=>$user->id,
         ];
         return $this->handelResponse($res,'register successfully');

    }
############################### LOGIN  Doctor ##########################
public function Login(Request $request){
    $validate = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);
    if ($validate->fails()) {
        return response()->json($validate->errors(),422);
    }
    if (Auth::guard('Doctor')->attempt(['email' => $request->email, 'password' => $request->password])) {
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
    public function Get(){
        $data=Doctor::all();
        return DoctorResources::collection($data)->resolve();
    }
    ########################## Find  Doctor with ID #######################

    public function Show(Request $request){
        $validate = Validator::make($request->all(), [
            'id'=>'required|exists:doctors,id',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }
        $data=Doctor::find($request->id);
        return DoctorResources::make($data)->resolve();

    }

    ########################## Update Doctor #######################
    public function Update(Request $request){
        $validate = Validator::make($request->all(), [
            'id'=>'required|exists:doctors,id',
            'name'=>'required|string',
            'image'=>'image',
            'address'=>'required|string',
            'fees'=>'required|integer',
            'doctor_category_id'=>'required|exists:doctor_categories,id'
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }
        $Doctor=Doctor::find($request->id);

        if ($request->hasFile('image')) {

            $this->fileRemove($Doctor->image);

            $image = $this->saveImage($request->file('image'), 'Doctors_Images');
        } else {
            $image = $Doctor->image;
        }
        $Doctor->Update([
            'name'=>$request->name,
            'image'=>$image,
            'address'=>$request->address,
            'fees'=> $request->fees,
            'doctor_category_id'=>$request->doctor_category_id,
        ]);

        return $this->handelResponse('','The Doctor has been Updated successfully');


    }

    ########################## Delete Doctor #######################
    public function Delete(Request $request){
        $validate = Validator::make($request->all(), [
            'id'=>'required|exists:doctors,id',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        Doctor::find($request->id)->delete();
        return $this->handelResponse('','The Doctor has been Deleted successfully');

    }

}
