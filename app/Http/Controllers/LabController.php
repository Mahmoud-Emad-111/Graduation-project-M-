<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabRequest;
use App\Http\Resources\LabResources;
use App\Models\Lab;
use Illuminate\Http\Request;
use App\Traits\SaveImage;
use App\Traits\SaveImagesTrait;
use Illuminate\Support\Facades\Validator;

class LabController extends Controller
{
    use SaveImagesTrait;
    //
    public function Store(LabRequest $request){
        $image=$this->saveImage($request->image,'LabImages');
        Lab::create([
            'title'=>$request->title,
            'name'=>$request->name,
            'image'=>$image,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ]);
        return $this->handelResponse('','The Lab has been added successfully');
    }
    ########################## Get All Lab #######################

    public function Get_All_Categories(){
        $data=Lab::all();
        return LabResources::collection($data)->resolve();
    }

    ########################## Find  Lab with ID #######################

    public function Show(Request $request){
        $validate = Validator::make($request->all(), [
            'id'=>'required|exists:labs,id',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }
        $data=Lab::find($request->id);
        return LabResources::make($data)->resolve();

    }

 ########################## Update Doctor #######################
 public function Update(Request $request){
    $validate = Validator::make($request->all(), [
        'id'=>'required|exists:labs,id',
        'name'=>'required',
        'image'=>'image',
        'address'=>'required|string',
        'phone'=>'required|numeric',
        'title'=>'required|string',
        'lab_category_id'=>'required|exists:lab_categories,id'
    ]);
    if ($validate->fails()) {
        return response()->json($validate->errors(),422);
    }
    $Lab=Lab::find($request->id);

    if ($request->hasFile('image')) {

        $this->fileRemove($Lab->image);

        $image = $this->saveImage($request->file('image'), 'LabImages');
    } else {
        $image = $Lab->image;
    }
    $Lab->Update([
        'title'=>$request->title,
        'name'=>$request->name,
        'image'=>$image,
        'phone'=>$request->phone,
        'address'=>$request->address,
    ]);

    return $this->handelResponse('','The Lab has been Updated successfully');

}
    ########################## Delete Lab #######################
    public function Delete(Request $request){
        $validate = Validator::make($request->all(), [
            'id'=>'required|exists:labs,id',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }

        Lab::find($request->id)->delete();
        return $this->handelResponse('','The Doctor has been Deleted successfully');

    }

}
