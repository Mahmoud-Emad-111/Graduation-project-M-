<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhysiotherapyCentreRequest;
use App\Http\Resources\PhysiotherapyCentreResources;
use App\Models\PhysiotherapyCentre;
use App\Traits\SaveImagesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhysiotherapyCentreController extends Controller
{
    //
    use SaveImagesTrait;
    //
    public function Store(PhysiotherapyCentreRequest $request){
        $image=$this->saveImage($request->image,'PhysiotherapyCentreImages');
        PhysiotherapyCentre::create([
            'title'=>$request->title,
            'name'=>$request->name,
            'image'=>$image,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ]);
        return $this->handelResponse('','The Physiotherapy Centre has been added successfully');
    }
    ########################## Get All PhysiotherapyCentre #######################

    public function Get(){
        $data=PhysiotherapyCentre::all();
        return PhysiotherapyCentreResources::collection($data)->resolve();
    }


        ########################## Find  PhysiotherapyCentre with ID #######################

        public function Show(Request $request){
            $validate = Validator::make($request->all(), [
                'id'=>'required|exists:physiotherapy_centres,id',
            ]);
            if ($validate->fails()) {
                return response()->json($validate->errors(),422);
            }
            $data=PhysiotherapyCentre::find($request->id);
            return PhysiotherapyCentreResources::make($data)->resolve();

        }

     ########################## Update Doctor #######################
     public function Update(Request $request){
        $validate = Validator::make($request->all(), [
            'id'=>'required|exists:physiotherapy_centres,id',
            'name'=>'required',
            'image'=>'image',
            'address'=>'required|string',
            'phone'=>'required|numeric',
            'title'=>'required|string',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors(),422);
        }
        $Lab=PhysiotherapyCentre::find($request->id);

        if ($request->hasFile('image')) {

            $this->fileRemove($Lab->image);

            $image = $this->saveImage($request->file('image'), 'PhysiotherapyCentreImages');
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

        return $this->handelResponse('','The Physiotherapy Centre has been Updated successfully');

    }
        ########################## Delete Physiotherapy Centre #######################
        public function Delete(Request $request){
            $validate = Validator::make($request->all(), [
                'id'=>'required|exists:physiotherapy_centres,id',
            ]);
            if ($validate->fails()) {
                return response()->json($validate->errors(),422);
            }

            PhysiotherapyCentre::find($request->id)->delete();
            return $this->handelResponse('','The Physiotherapy Centred has been Deleted successfully');

        }

}
