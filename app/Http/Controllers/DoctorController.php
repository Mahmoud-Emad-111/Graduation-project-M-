<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResources;
use App\Models\Doctor;
use App\Traits\SaveImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    //
    use SaveImage;
    public function Store(DoctorRequest $request){
        $image=$this->saveImage($request->image,'Doctors Images');
        Doctor::create([
            'name'=>$request->name,
            'image'=>$image,
            'address'=>$request->address,
            'fees'=> $request->fess,
            'doctor_category_id'=>$request->doctor_category_id,
        ]);
        return $this->handelResponse('','The Doctor has been added successfully');
    }
    public function Get(){
        $data=Doctor::all();
        return DoctorResources::collection($data)->resolve();
    }
 ########################## Delete Doctor #######################

    public function Delete(Request $request){
        $validate = Validator::make($request->all(), [
            'id'=>'required|exists:Doctor,id',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        Doctor::find($request->id)->delete();
        return $this->handelResponse('','The Doctor has been Deleted successfully');

    }

}
