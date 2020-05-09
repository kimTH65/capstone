<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\design_board;
use App\design_form;
use DB;
use Illuminate\Filesystem\Filesystem;
use File;

class DesignBoardController extends Controller
{
    public function design_board()
    {
        //--------------- update ------------------------------------------------
        $d_boards = design_board::all()->whereNull('deleted_at');
        $d_pages = DB::table('design_boards')->whereNull('deleted_at')->paginate(6);
        //-------------- ------- -------------------------------------------------
        return view('design_board',['d_boards' => $d_boards],['d_pages' => $d_pages]);

    }
    public function design_write()
    {
       return view('design_write');
    }
     public function design_write_process(Request $request)
    {
           $user_id = $request->input('user');
           $title = $request->input('title');
           $content = $request->input('description');
           $sub_content = $request->input('description2');
         
         
           $curTime = new \DateTime();
           $created_at = $curTime->format("Y-m-d H:i:s");
         
         
         
         $design_boards = [
             'user_id' => $user_id,
             'title' => $title,
             'content' => $content,
             'subcontent' => $sub_content,
             'date' => $created_at,
             ];
       
           if($designimages = DB::table('design_boards')->max('id'))
           {
               
           }
           else
           {
             $designimages = 1;
           }
           $design_board = design_board::create($design_boards);
         
            //----------------------------- new -----------------------------------------
            $user_count = DB::table('homes')->count();
            $count = DB::table('design_boards')->count();
            
            $new_score = "0";
            for($j =1; $j<$user_count; $j++)
            {
                 $new_score=$new_score."0";
            }
              
            $vector_set = DB::table('design_boards')->where('id',$count)->update(['vector' => $new_score]);
                
             
            //----------------------------- ----- -------------------------------------------
         
         /* 현재 사용자가 가지고 있는 템플릿 갯수를 리턴함*/
        //$designimages = \App\design_board::where('user_id','=', $user_id)->count();
         
         //$designimages = DB::table('design_boards')->count();
         //$designimages = DB::table('design_boards')->max('id');
         
            return view('/design_write_process',[
                'designimages' => $designimages,
                'user_id' => $user_id
                ]);
    }
    public function design_read(Design_Board $d_page)
    {
        //------------------------------ update ----------------------------------
        $d_boards = design_board::all()->whereNull('deleted_at');
        
        return view('design_read',['d_page' => $d_page,'d_boards' => $d_boards]);
        //------------------------------------------------------------------------
    }
     public function design_delete(Design_Board $d_page)
    {
       $dir = "./design_image/$d_page->id"; // 삭제 대상 폴더

        File::deleteDirectory(public_path($dir));
        $d_page->delete();
        return redirect('/design_board');
    }
    public function design_form(Request $request)
    {
           $designer_id = $request->input('designer_id');
           $board_no = $request->input('board_no');
           $u_pou = $request->input('u_pou');
           $u_moredetails = $request->input('u_moredetails');
           $applicant = $request->input('applicant');
        
            

            $name = "이름 불필요";
            $phone = "연락처 불필요";
            $email = "이메일 불필요";
            $position = "직책 불필요";
            $address = "주소 불필요";
            $group = "그룹 불필요";
        
            $list = $request->input('info');
        
            for($i=0;$i<count($list);$i++)
            {
                if($list[$i] === "이름 필요")
                {
                    $name = $list[$i];
                }
                if($list[$i] === "연락처 필요")
                {
                    $phone = $list[$i];
                }
                if($list[$i] === "이메일 필요")
                {
                    $email = $list[$i];
                }
                if($list[$i] === "직책 필요")
                {
                    $position = $list[$i];
                }
                if($list[$i] === "주소 필요")
                {
                    $address = $list[$i];
                }
                if($list[$i] === "단체명 필요")
                {
                    $group = $list[$i];
                }
            }
        
        $curTime = new \DateTime();
        $created_at = $curTime->format("Y-m-d H:i:s");
         
         $design_forms = [
             'design_form_boar_no' => $board_no,
             'design_form_designer' => $designer_id,
             'design_form_applicant' => $applicant,
             'design_form_detail' => $u_moredetails,
             'design_form_progress' => '요청',
             'design_form_name' => $name,
             'design_form_phone' => $phone,
             'design_form_email' => $email,
             'design_form_position' => $position,
             'design_form_address' => $address,
             'design_form_group' => $group,
             'date' => $created_at
             ];
       

           $design_form = design_form::create($design_forms);
        
        
        
        
        return view('design_form');
    }
    public function design_Status()
    {
        $d_boards = design_board::all();
        $form_pages = DB::table('design_forms')->paginate(5);
        
        
        return view('design_Status',['d_boards'=>$d_boards],['form_pages'=>$form_pages]);
    }
    public function design_form_process(Request $request)
    {
        
       $bo_no = $request->input('board_no');
       $applicant = $request->input('applicant');
       $proge = $request->input('progess');
        
        if($proge === "요청")
        {
            $proge = "수락";
            DB::table('design_forms')
            ->where('design_form_boar_no', $bo_no)->where('design_form_applicant',$applicant)
            ->update(['design_form_progress' => $proge]);
        
               return view('design_form_process');
        }
        else if($proge === "수락")
        {
            $proge = "제작";
            DB::table('design_forms')
            ->where('design_form_boar_no', $bo_no)->where('design_form_applicant',$applicant)
            ->update(['design_form_progress' => $proge]);
        
            return view('design_form_process');
        }
        else if($proge === "제작")
        {
            $proge = "완료";
            DB::table('design_forms')
            ->where('design_form_boar_no', $bo_no)->where('design_form_applicant',$applicant)
            ->update(['design_form_progress' => $proge]);
        
            return view('design_form_process');
        }
        else if($proge === "완료")
        {
            $proge = "거래완료";
            DB::table('design_forms')
            ->where('design_form_boar_no', $bo_no)->where('design_form_applicant',$applicant)
            ->update(['design_form_progress' => $proge]);
        
            return view('design_form_process');
        }
        
    }
    // --------------------------------- new -------------------------------------------
    public function design_vector(Request $request)
    {    
        $user_id = $request->input('user_id');
        $user= DB::table('homes')->where('user_id',$user_id)->get('user_no');
        $use= json_decode($user,true);
        $us = $use[0]["user_no"];
        
        $vector_score = $request->input('vector_score');
        
        $d_page = $request->input('d_page');
        $score= $request->input('score');
        
        $vector = [];
        $vector = str_split($vector_score);
        
        for ($i =0; $i<count($vector); $i++)
        {
            if($us-1== $i){
                $vector[$i] = $score;
            }
        }
        
        $vector_result= implode("", $vector);
        
        $board = DB::table('design_boards')->whereNull('deleted_at')->where('id',$d_page)->update(['vector' => $vector_result]);
        
       
        return redirect('/design_board');
    }
    //----------------------------------------------------------------------------------
}



