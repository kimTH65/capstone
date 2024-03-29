<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template_table;
use App\image_template_table;
use DB;

class TemplateTableController extends Controller
{
    public function TemplatePage()
    {
        return view('TemplatePage');
    }
    public function TemplatePage_1(Request $request)
    {
       session_start();
       $_SESSION['id'];
         
       if($template_user = DB::table('template_tables')->where('user_id', $_SESSION['id'])->first())
       {
            return view('template_page.TemplatePage_1',
                  ['template_user' => $template_user
                      ]);   
       }
       else
       {  
           return view('template_page.TemplatePage_1');
       }
    }
    public function TemplatePage_upload(Request $request)
    {
         $user_id = $request->input('user_id');
         $toptitle_text = $request->input('toptitle_text');
         $title_text = $request->input('title_text');
         $small_title = $request->input('small_title');
         $intro_text = $request->input('intro_text');
        $memo_text = $request->input('memo_text');
        $tel_text1 = $request->input('tel_text1');
        $tel_text2 = $request->input('tel_text2');
        $tel_text3 = $request->input('tel_text3');
        $info_title = $request->input('info_title');
        $info_text = $request->input('info_text');
        $lo_title = $request->input('lo_title');
        
        $Template_table = \App\Template_table::where('user_id','=', $user_id)->first();
        
        if(empty($Template_table))
        {
            $Template_table = new Template_table;
            $Template_table->user_id = $user_id;
            $Template_table->template_title = $toptitle_text;
            $Template_table->template_title_text = $title_text;
            $Template_table->template_title_small = $small_title;
            $Template_table->template_intro_text = $intro_text;
            $Template_table->template_memo_text = $memo_text;
            $Template_table->template_tel = $tel_text1;
            $Template_table->template_email = $tel_text2;
            $Template_table->template_fax = $tel_text3;
            $Template_table->template_info_title = $info_title;
            $Template_table->template_info_text = $info_text;
            $Template_table->template_location = $lo_title;
            $Template_table->save();
            
            return view('template_page.TemplatePage_upload',[
                '$Template_table' => $Template_table
                ]);
        }
        else
        {
           $Template_table = DB::table('template_tables')
            ->where('user_id', '=', $user_id)
            ->update([
                'template_title' => $toptitle_text,
                'template_title_text' => $title_text,
                'template_title_small' => $small_title,
                'template_intro_text' => $intro_text,
                'template_memo_text' => $memo_text,
                'template_tel' => $tel_text1, 
                'template_email' => $tel_text2, 
                'template_fax' => $tel_text3, 
                'template_info_title' => $info_title, 
                'template_info_text' => $info_text, 
                'template_location' => $lo_title
            ]);
            return view('template_page.TemplatePage_upload',[
                '$Template_table' => $Template_table
                ]);
        }  
    }
    public function TemplatePage_Image1(Request $request) // 이미지1 업로드
    {
       session_start();
       $_SESSION['id'];
        
        if($template_user = DB::table('image_template_tables')->where('user_id', $_SESSION['id'])->first())
       {
            return view('template_page.TemplatePage_Image1',
                  ['template_user' => $template_user
                      ]);   
       }
       else
       {  
          return view('template_page.TemplatePage_Image1');
       }
    }
    public function TemplatePage_image_upload(Request $request)
    {
         $user_id = $request->input('user_id');
         $toptitle_text = $request->input('toptitle_text');
         $title_text = $request->input('title_text');
         $small_title = $request->input('small_title');
         $intro_text = $request->input('intro_text');
        $memo_text = $request->input('memo_text');
        $tel_text1 = $request->input('tel_text1');
        $tel_text2 = $request->input('tel_text2');
        $tel_text3 = $request->input('tel_text3');
        $info_title = $request->input('info_title');
        $info_text = $request->input('info_text');
        $lo_title = $request->input('lo_title');
        
        $Template_table = \App\image_template_table::where('user_id','=', $user_id)->first();
        
        if(empty($Template_table))
        {
            DB::insert('insert into image_template_tables (user_id, template_title,template_title_text,template_title_small,template_intro_text,template_memo_text,template_tel,template_email,template_fax,template_info_title,template_info_text,template_location) values (?, ?,?,?,?,?,?,?,?,?,?,?)', [$user_id, $toptitle_text,$title_text,$small_title,$intro_text,$memo_text, $tel_text1,$tel_text2,$tel_text3,$info_title,$info_text,$lo_title]);
            
            return view('template_page.TemplatePage_image_upload',[
                '$Template_table' => $Template_table
                ]);
        }
        else
        {
           $Template_table = DB::table('image_template_tables')
            ->where('user_id', '=', $user_id)
            ->update([
                'template_title' => $toptitle_text,
                'template_title_text' => $title_text,
                'template_title_small' => $small_title,
                'template_intro_text' => $intro_text,
                'template_memo_text' => $memo_text,
                //'template_tel' => $tel_text1, 
                //'template_email' => $tel_text2, 
                //'template_fax' => $tel_text3, 
                //'template_info_title' => $info_title, 
                //'template_info_text' => $info_text, 
                //'template_location' => $lo_title
            ]);
            return view('template_page.TemplatePage_image_upload',[
                '$Template_table' => $Template_table
                ]);
        }
    }
    
}
