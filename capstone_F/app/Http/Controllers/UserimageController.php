<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userimage;
use DB;

class UserimageController extends Controller
{
    public function toolPage(Request $request)
    {
       return view('/toolPage');    
     }
    public function action_upload(Request $request)
    {
        /* 리턴받은 템플릿 갯수를 바탕으로 특정 폴더에 이미지를 업로드 및 DB에 값을 넣음*/
        $user_id = $request->user_id;
        $title = $request->title;

         $Userimages = [
            'image_title' => $title,
            'user_id' => $user_id,
           ];

            $Userimage = Userimage::create($Userimages);

            return view('/toolPage');
    }
    public function searchDir(Request $request)
    {
        /* 현재 사용자가 가지고 있는 템플릿 갯수를 리턴함*/
        $user_id = $request->user_id;
        $userimages = \App\Userimage::where('user_id','=', $user_id)->count();
            return view('/searchDir',[
                'userimages' => $userimages,
                'user_id' => $user_id
                ]);
    }
}
