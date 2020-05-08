<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question_board;
use App\q_reply;
use DB;

class QuestionBoardController extends Controller
{
    public function question_board()
    {
        $question_boards = question_board::all();
        $q_pages = DB::table('question_boards')->paginate(15);

        return view('question_board',['question_boards' => $question_boards],['q_pages' => $q_pages]);
    }
    public function question_write()
    {
        return view('question_write');
    }
     public function question_write_ok(Request $request)
    {
           $user_id = $request->input('name');
           $title = $request->input('title');
           $content = $request->input('content');
         
         $curTime = new \DateTime();
         $created_at = $curTime->format("Y-m-d H:i:s");
         
         
         
         $question_boards = [
             'user_id' => $user_id,
             'title' => $title,
             'content' => $content,
             'date' => $created_at
             ];
       

           $question_board = question_board::create($question_boards);

    
        return view('question_write_ok');
    }
    public function question_read(Question_board $q_page)
    {
        //$q_reply = q_reply::all();
        $q_reply = DB::table('q_replies')->where('con_num', '=', $q_page->id)->get();

        return view('question_read',['q_page' => $q_page],['q_reply' => $q_reply]);
    }
      public function question_update(Question_board $q_page)
    {

        return view('question_update',['q_page' => $q_page]);
    }
    public function question_update_process(Request $request)
    {
        $board_no = $request->input('board_no');
        $title = $request->input('title');
        $user_id = $request->input('user');
        $content = $request->input('description');
        
        
        DB::table('question_boards')
            ->where('id', $board_no)
            ->update(['content' => $content]);
         
        return redirect('/question_read/'.$board_no);
    }
    public function question_delete(Question_board $q_page)
    {
        $q_page->delete();
         
       return redirect('/question_board');
    }
    
    public function q_comment_process(Request $request)
    {
           $board_no = $request->input('board_no');
           $user_id = $request->input('user_id');
           $content = $request->input('content');
        
                 DB::table('q_replies')->insert(
            ['con_num' => $board_no, 'name' => $user_id, 'content' => $content]
        );
         
         
         $boards = [
             'board_no' => $board_no
             ];
        
        
        return redirect('/question_read/'.$board_no);
    }
    public function q_co_delete(Q_reply $q_reply)
    {
        $q_reply->delete();
         
       return redirect('/question_board/');
    }
}
