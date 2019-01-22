<?php 

namespace App\Http\Controllers;

use \Input as Input;
use File;

class UploadController extends Controller {

	public function upload(){
		$user = new file;

		if(Input::hasFile('file')){

			echo 'Uploaded';
			$file = Input::file('file');
			$file->move(public_path(). '/images', $file->getClientOriginalName());
			
		}

	}
	public function AddPicture($id)
        {
            $id_activity = $id;
            $user = new file;
            if(Input::hasFile('file')){
                $file = Input::file('file');
                $file->move(public_path(). '/images', $file->getClientOriginalName());
                $user->title = $file->getClientOriginalName();
                $id = DB::getPdo()->lastInsertId();
                DB::table('image_activity')->insert(array(
                    'url_image'=>$user->title,
                    'id_activity'=>$id_activity
                ));

            }
            return back();

        }
}