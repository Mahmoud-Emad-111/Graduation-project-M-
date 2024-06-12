<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait SaveImage
{



    public function saveImage($image, string $name)
    {
        $full=$image->store($name);
        return $full;
    }

    public function fileRemove($file){
        if (Storage::exists($file)) {
            Storage::delete($file);
        }
    }

    // public function Delete($model,int $id){

    //     $model::find($id)->delete();

    // }

}
