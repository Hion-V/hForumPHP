<?php
class AssetHandler{

static function printAsset($image, $doSize=false, $size=128){
    if($doSize){
        echo  '<img src="./img/'.$image.'" width='.$size.' height='.$size.' >';
    }
    else{
        echo  '<img src="./img/'.$image.'>';
    }
}



}

?>