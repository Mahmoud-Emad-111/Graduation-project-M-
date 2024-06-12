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
    ########################## Find  Doctor with ID #######################

    public function Show(Request $request){
        $validate = Validator::make($request->all(), [
            'id'=>'required|exists:Doctor,id',
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
            'id'=>'required|exists:Doctor,id',
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

            $image = $this->saveImage($request->file('image'), 'Articles_image');
        } else {
            $image = $Doctor->image;
        }
        $Doctor->Update([
            'name'=>$request->name,
            'image'=>$image,
            'address'=>$request->address,
            'fees'=> $request->fess,
            'doctor_category_id'=>$request->doctor_category_id,
        ]);

        return $this->handelResponse('','The Doctor has been Updated successfully');


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
