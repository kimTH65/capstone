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
<link rel="stylesheet" type="text/css" href="../css/read.css">
<link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
@endsection
    
@section('head')    
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>  
@endsection
    

    
@section('contents')
    <middle>
    <p style="font-size:5rem; font-weight:bolder;text-align:center;">커뮤니티 게시판</p>
        <div id="jb-container">


        <br><br><br><br>
        <div id="text-body">
        <form action = "/update_process" method = "POST" class="form-horizontal" role="form"  enctype="multipart/form-data"> 
            {{ csrf_field() }}
            <input type ="hidden" name ="board_no" value = {{ $page->id }}>
            <div class="form-group"> 
                <label for="title" class="col-sm-2 control-label">제목</label> 
                 <div class="col-sm-10"> 
                 <input type="text" class="form-control" name = "title" style="width:400px; background-color:white;" id="title" readonly value = {{ $page->title }}>
                </div> 
            </div> 

            <div class="form-group"> 
                 <label for="user" class="col-sm-2 control-label">작성자</label>
                    <div class="col-sm-10"> 
                     <input type="text" class="form-control" name = "user" style = "width : 150px;"id="user" readonly value = {{ $page->user_id }}>
                    </div>
            </div>

            <div class="form-group"> 
                 <label for="author" class="col-sm-2 control-label">내용</label>
                    <div class="col-sm-10"> 
                    <textarea class="form-control" rows="20" name = "description" style = "width:700px; background-color:white;">{{ $page->content }}</textarea>
                    </div>
            </div>

                 <?php
            if($_SESSION['id'] == $page->user_id)
            {
            ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10"> 
                <button type="submit" class="btn btn-success">수정 완료</button>
                    <a href = "question_board.php" style = "color:black"><button type="button" class="btn btn-info">돌아가기</button></a>
                </div> 
            </div>
            <?php
            }
            ?>

            <?php if($_SESSION['id'] != $page->user_id)
            {
            ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10"> 
                <a href = "question_board.php" style = "color:white;"><button type="button" class="btn btn-info">돌아가기</button></a>
                </div> 
            </div>
            <?php
            }
            ?>


           


            
        </form>    
            
        </div>
        </div>
</middle>
                
                
 
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