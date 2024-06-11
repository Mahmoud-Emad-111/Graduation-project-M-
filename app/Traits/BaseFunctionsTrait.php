<?php

namespace App\Traits;

trait BaseFunctionsTrait
{


    public function Get($model){
        return $model::get();

    }


    public function show($model,int $id){
        return $data=$model::find($id);
    }

    // public function Delete($model,int $id){

    //     $model::find($id)->delete();

    // }

}
