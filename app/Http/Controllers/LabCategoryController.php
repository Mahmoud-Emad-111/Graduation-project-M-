<?php

namespace App\Http\Controllers;

use App\Models\LabCategory;
use App\Traits\BaseFunctionsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LabCategoryController extends Controller
{
    //
    use BaseFunctionsTrait;

    ########################## Store Category #######################
        public function Store(Request $request){
            $validate = Validator::make($request->all(), [
                'Title' => 'required|string',
            ]);
            if ($validate->fails()) {
                return response()->json($validate->errors(),422);
            }
            LabCategory::create([
                'Title'=>$request->Title,
            ]);
            return $this->handelResponse('','The Category has been added successfully');
        }
    ########################## Get All Categories #######################

        public function Get_All_Categories(){
            return $this->Get(LabCategory::class);
        }
    ########################## Delete Category #######################

        public function Update(Request $request){
            $validate = Validator::make($request->all(), [
                'id'=>'required|exists:lab_categories,id',
                'Title' => 'required|string',

            ]);
            if ($validate->fails()) {
                return response()->json($validate->errors(),422);
            }

            LabCategory::find($request->id)->Update([
                'Title'=>$request->Title,

            ]);
            return $this->handelResponse('','The Category has been Updated successfully');

        }



    ########################## Delete Category #######################

        public function Delete(Request $request){
            $validate = Validator::make($request->all(), [
                'id'=>'required|exists:lab_categories,id',
            ]);
            if ($validate->fails()) {
                return response()->json($validate->errors(),422);
            }

            LabCategory::find($request->id)->delete();
            return $this->handelResponse('','The Category has been Deleted successfully');

        }

}
