<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\repre_img;
use App\template_table;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class RepreImgController extends Controller
{
    public function MyTemplate(Request $request)
    {
        return view('MyTemplate');
    }
     public function MyTemplate_process(Request $request)
    {
        $user_id = $request->input('base_id');
       $type = $request->input('base_im');
       $img_name = $request->input('base_number');
          
          
    $repre_img = DB::table('repre_imgs')->
         updateOrInsert(
        ['user_id' => $user_id],
        ['type' => $type, 'img_name' => $img_name, 'user_id' => $user_id]
    );
          
           return view('MyTemplate_process',[
                    'repre_img' => $repre_img
                    ]);
    }
    
     public function myTemplate1()
    {
         session_start();
         $_SESSION['id'];
         
         $template_user = DB::table('template_tables')->where('user_id', $_SESSION['id'])->first();
       
       return view('template_page.myTemplate1',
                  ['template_user' => $template_user
                      ]);   
    }
}
?>