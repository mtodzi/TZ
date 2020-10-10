<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class ImagesWorking
{
    public static function addImagesProduct(array $images, int $id){
        $imgCount = count($images);
        foreach(range(0, $imgCount-1) as $index) {           
            Storage::disk('product')->putFile($id, $images[$index]);
        }
    }
    
    public static function getUrlImgProduct(int $id){
        $arrayImg = [];
        $files = Storage::disk('product')->files($id);
        foreach ($files as $file){
            array_push($arrayImg, Storage::url("product/".$file));
        }
        return $arrayImg;
    }
    
    public static function deleteImgProduct(int $id,string $url){
        $file = explode("/", $url);
        $url = $id."/".end($file);
        if(Storage::disk('product')->exists($url)){
            Storage::disk('product')->delete($url);
        }    
    }
    
    public static function deleteImgProductAll(int $id){
        $files = Storage::disk('product')->files($id);
        foreach ($files as $file){
            Storage::disk('product')->delete($file);
        }
        Storage::disk('product')->deleteDirectory($id);
    }
}
