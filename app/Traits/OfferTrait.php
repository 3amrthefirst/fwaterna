<?php

namespace App\Traits;


Trait OfferTrait
{
     function saveimage($photo,$folder){
        $file_exe = $photo->getClientOriginalExtension();
        $file_name = time() .'.'. $file_exe;
        $path = $folder;
        $photo -> move($path,$file_name);
        return $file_name;



    }
}
