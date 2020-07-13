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
    
     public function myTemplate1(Request $request)
    {
         session_start();
         $_SESSION['id'];
         
         //$user_id = $request->input('mId');
             
         //echo $user_id;

         $template_user = DB::table('template_tables')->where('user_id', $_SESSION['id'])->first();
       
       return view('template_page.myTemplate1',
                  ['template_user' => $template_user
                      ]);   
    }
    
     public function myTemplate2(Request $request)
    {
         session_start();
         $_SESSION['id'];
         
         //$user_id = $request->input('mId');
             
         //echo $user_id;

         $template_user = DB::table('image_template_tables')->where('user_id', $_SESSION['id'])->first();
       
       return view('template_page.myTemplate2',
                  ['template_user' => $template_user
                      ]);   
    }
    
     public function repre_template(Request $request)
    {
         $user_id = $request->input('mId');
         
         $repre = \App\repre_img::where('user_id','=', $user_id)->first();
         
         if($repre->type == "text")
         {
             $template_user = DB::table('template_tables')->where('user_id', $repre->user_id)->first();
              return view('template_page.myTemplate1',
                  ['template_user' => $template_user
                      ]);   
         }
         else if($repre->type == "img")
         {
             $template_user = DB::table('image_template_tables')->where('user_id', $repre->user_id)->first();
              return view('template_page.myTemplate2',
                  ['template_user' => $template_user
                      ]);   
         }
         else if($repre->type == "base")
         {
             return view('template_page.repre_base',
                  ['repre' => $repre
                      ]);
                  
         }
         
         
         return view('template_page.repre_template');
    }
}
?>