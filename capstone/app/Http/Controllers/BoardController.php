<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\board;
use App\reply;
use DB;

class BoardController extends Controller
{
    public function board()
    {
        $boards = board::all();
        $pages = DB::table('boards')->paginate(15);

        return view('board',['boards' => $boards],['pages' => $pages]);
    }
    
    public function write()
    {
        return view('write');
    }
     public function write_ok(Request $request)
    {
           $user_id = $request->input('name');
           $title = $request->input('title');
           $content = $request->input('content');
         
         $curTime = new \DateTime();
         $created_at = $curTime->format("Y-m-d H:i:s");
         
         
         
         $boards = [
             'user_id' => $user_id,
             'title' => $title,
             'content' => $content,
             'date' => $created_at
             ];
       

           $board = board::create($boards);

    
        return view('write_ok');
    }
    public function read(Board $page)
    {
        //$reply = reply::all();
        $reply = DB::table('replies')->where('con_num', '=', $page->id)->get();
        return view('read',['page' => $page],['reply' => $reply]);
    }
    public function update(Board $page)
    {
        
        
        
        return view('update',['page' => $page]);
    }
    public function comment_process(Request $request)
    {
           $board_no = $request->input('board_no');
           $user_id = $request->input('user_id');
           $content = $request->input('content');
        
         DB::table('replies')->insert(
    ['con_num' => $board_no, 'name' => $user_id, 'content' => $content]
);
         
         
         $boards = [
             'board_no' => $board_no
             ];
        
        
        return redirect('/read/'.$board_no);
    }
     public function delete(Board $page)
    {
        $page->delete();
         
       return redirect('/board');
    }
    public function co_delete(Reply $reply)
    {
        $reply->delete();
         
       return redirect('/board/');
    }
    public function update_process(Request $request)
    {
        $board_no = $request->input('board_no');
        $title = $request->input('title');
        $user_id = $request->input('user');
        $content = $request->input('description');
        
        
        DB::table('boards')
            ->where('id', $board_no)
            ->update(['content' => $content]);
         
        return redirect('/read/'.$board_no);
    }
}
