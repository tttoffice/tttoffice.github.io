<?php

use App\Models\ActivityType;
use App\Models\Constant;
use App\Models\Conversation;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\NotificationRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;




/**
 * Get list of languages
 */





/**
 * Upload
 */
 if (! function_exists('upload')) {
 	function upload($file, $path)
 	{
        $baseDir = 'uploads/' . $path;
        // $baseDir =   $path;

        $name = sha1(time() . $file->getClientOriginalName());
        $extension = $file->getClientOriginalExtension();
        $fileName = "{$name}.{$extension}";

        $file->move(public_path() . '/' . $baseDir, $fileName);

        // return "{{$baseDir}}/{{$fileName}}";
        return $fileName;
 	}
 }


 if (! function_exists('verification_type')) {
    function verification_type($type)
    {

      if($type == 1){
       return 'register';
      }elseif($type == 2){
       return 'forget';
      }else{
          return 'login';
      }
    }
}

##########################################################################
##########################################################################
##########################################################################
##########################################################################
/**
 * Store Data in Medias Table
 */
if (!function_exists('storeMedia')) {
    function storeMedia($path,$file, $id ,$model)
    {
        DB::table('medias')->insert(
            [
                'file' => upload($path, $file),
                'mediable_id' => $id,
                'mediable_type' => $model
            ]
        );
    }
}

/**
 * Store Data in Medias Table
 */
if (!function_exists('storeMediaPath')) {
    function storeMediaPath($path, $id, $model)
    {
        DB::table('medias')->insert(
            [
                'file'=> $path,
                'mediable_id' => $id,
                'mediable_type' => $model
            ]
        );
    }
}

if (!function_exists('isRtl')) {
	function isRtl($value) {
		$rtlChar = '/[\x{0590}-\x{083F}]|[\x{08A0}-\x{08FF}]|[\x{FB1D}-\x{FDFF}]|[\x{FE70}-\x{FEFF}]/u';

		$isRtl = preg_match($rtlChar, $value) != 0;

		if($isRtl == true){
			return true;
		}
		return false;

	}
}
