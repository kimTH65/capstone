<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\home;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    // 메인화면
    public function index()
    {
        return view('index');
    }
  
    // 회원가입
    public function signup(Request $request)
    {
            $user_id = $request->input('uId');
            $user_pw = $request->input('uPass');
            $user_nick = $request->input('uNick');
            $user_job = $request->input('Job');
        
        /* 현재 id와 닉네임을 찾아보고 있으면 signup 에서 예외처리를 함*/
        try
        {
            if($home = \App\home::where('user_id','=', $user_id)->orWhere('user_nick','=',$user_nick)->first())
            {
                return view('/signup',[
                    'home' => $home
                    ]);
            }/* 만약 등록된 아이디, 닉네임이 없다면 모델로 배열을 넘겨 회원을 생성*/
            else
            {
                $homes = [
                'user_id' => $user_id,
                'user_pw' => $user_pw,
                'user_nick' => $user_nick,
                'user_job' => $user_job,
               ];

                $home = home::create($homes);
                // new--------------
                $user_count = DB::table('homes')->count();
                $count = DB::table('design_boards')->count();

                $new_score = "0";

                for($j =1; $j<$user_count; $j++)
                {
                     $new_score=$new_score."0";
                }
                for($i =1; $i<=$count;$i++)
                {
                    $vector_score=DB::table('design_boards')->where('id',$i)->get('vector');
                    $vec = json_decode($vector_score,true);
                    $ve = $vec[0]["vector"];
                    $vector_set = DB::table('design_boards')->where('id',$i)->update(['vector' => $ve."0"]);

                    if($i == $count){
                        $vector_set = DB::table('design_boards')->where('id',$i)->update(['vector' => $new_score]);
                    }

                }

                //-------------------
                 return view('/signup');
            }
        }catch(\Exception $e) 
        {
           return redirect('/');
        }
        
    }
    // 로그인
    public function login(Request $request)
    {
        $user_id = $request->input('uId');
        $user_pw = $request->input('uPass');
        /* 모델에게 테이블의 user_id, user_pw 와 $user_id, $user_pw를 비교해서 첫번째 값만 가져오라고 명령 */
       if($home = \App\home::where('user_id','=', $user_id)->Where('user_pw','=',$user_pw)->first())
        {
            return view('/index',[
                'home' => $home
                ]);
        }
        else
        {
            return view('/index');
        }
    }
    // 로그아웃
     public function logout()
    {
        return view('/logout');
    }
    
}
