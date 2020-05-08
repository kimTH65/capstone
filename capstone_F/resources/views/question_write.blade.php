@extends('Mainlayout')
<?php session_start(); ?> <!-- 세션 전역에서 사용 -->
<?php

function goto_caution($msg, $url)
{
    $str = "<script>";
    $str .= "alert('{$msg}');";
    $str .= "location.href = '{$url}';";
    $str .= "</script>";
    echo("$str");
    exit;
}
    
if(!isset($_SESSION['id']) && !isset($_SESSION['password']))
{
    goto_caution("로그인을 해주세요","/");
}

?>
    
@section('style')
    <link rel="stylesheet"  type="text/css" href="css/board.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
     <style>   #jb-container 
      {
        width: 940px;
        margin: 0px auto;
        padding: 10px;
        margin-top:15px;
        margin-left:270px;
        /*border: 1px solid #bcbcbc;*/
        box-shadow: 1px 1px 3px 3px #F5F5F5;
        float:left;
        left:0px;
        clear:both;
        margin-bottom:105px;

      }</style>
@endsection    
    
@section('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection    
    
    
    
    
    
    
    
    
    
   
    
    
@section('contents')
     <div id="jb-container">
      <div id="board_write" class="container marketing">
        
        <h1><a href="#">문의 게시판</a></h1>
        <h4>문의 할 글을 작성하는 공간입니다.</h4>
            <div id="write_area">
                <form action="/question_write_ok" method="post"  enctype="multipart/form-data">
      {{ csrf_field() }}
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <textarea name="name" id="uname" rows="1" cols="55" placeholder="글쓴이" maxlength="100" required readonly><?php echo $_SESSION['id']?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_file" style="margin-top: 20px; margin-bottom: 20px;">
                        <h3 style="color: #333; font-weight: bold; margin-bottom: 10px;">파일 첨부하기</h3> <input type="file" value="1" name="b_file" />
                    </div>
                    <div class="wi_line"></div>
                    <div>
                        <textarea name="content" style="width: 75%; height:400px; margin-top: 30px;" placeholder="내용" required></textarea>
                    </div>
                    <div class="bt_se">
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

    
    
    
@section('bodybottom')
 <foot>
        
        <div class="row-md-3" style="height: 140px;background: #333333; clear:both;">    
            <div class="container" style="color:white;">
                <div class="row">
                    <div class="col-lg-4" > 
                        <h3>Address</h3>
                                1234 Somewhere Road<br>
                                Nashville, TN 00000
                    </div>
                    
                    <div class="col-lg-4" > 
                        <h3>Mail</h3>
                                <a href="#">someone@untitled.tld</a>
                    </div>   
                    
                    <div class="col-lg-4" > 
                        <h3>Phone</h3>
                                (000) 000-0000
                    </div>   
                    
                    <div class="copyright" style="margin-top: 30px; margin-bottom: 20px;">
                        
                        © Untitled. All rights reserved.  
                        
                    </div>
                </div>    
            </div>
        </div>
        
    </foot>
@endsection          
    
    
    
    
    
    
    
    
@section('bottom')    
@endsection     