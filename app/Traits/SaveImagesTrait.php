<?php

namespace App\Traits;

trait SaveImage
{



    public function saveImage($image, string $name)
    {
        $full=$image->store($name);
        return $full;
    }

    // public function Delete($model,int $id){

    //     $model::find($id)->delete();

    // }

}
