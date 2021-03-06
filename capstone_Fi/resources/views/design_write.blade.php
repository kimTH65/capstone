
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
    <link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
           
    <style>   #jb-container 
       .navbar
      {
        box-shadow: 1px 1px 3px 3px #F5F5F5;
        background-color : white;
        
      }
      li
      {
        margin-left : 3px;
        margin-top : 5px;
        float:left;
      }
      #text-body
      {
        display: flex;justify-content: center;
      }</style>
@endsection    
    
@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection    
    
    
    
    
@section('contents')
     <middle>
        <div id="text-body">
        <form action = "/design_write_process" method = "POST" class="form-horizontal" role="form"  enctype="multipart/form-data"> 
              {{ csrf_field() }}
            <div class="form-group"> 
                <label for="title" class="col-sm-2 control-label">제목</label> 
                 <div class="col-sm-10"> 
                 <input type="text" class="form-control" name = "title" style="width:400px;" id="title" placeholder="제목을 입력하세요"> 
                </div> 
            </div> 

            <div class="form-group"> 
                 <label for="user" class="col-sm-2 control-label">작성자</label>
                    <div class="col-sm-10"> 
                     <input type="text" class="form-control" name = "user" style = "width : 150px;"id="user" readonly value = <?php echo $_SESSION['id'];?>>
                    </div>
            </div>

            <div class="form-group"> 
                 <label for="author" class="col-sm-2 control-label">세부 내용</label>
                    <div class="col-sm-10"> 
                    <textarea class="form-control" rows="20" name = "description" style = "width:700px;"></textarea>
                    </div>
            </div>

            <div class="form-group"> 
                 <label for="author" class="col-sm-2 control-label">추가 내용</label>
                    <div class="col-sm-10"> 
                    <textarea class="form-control" rows="7" name = "description2" style = "width:700px;"></textarea>
                    </div>
            </div>

            
            

            <div style ="margin-left:135px; margin-bottom:25px;">
                <h4>제작한 디자인</h4>
                <label class="btn btn-primary">
                    main_image&hellip; <input type="file" name = "main_image" style="display: none;" onchange="alert('파일 업로드 성공');">
                </label>

                <label class="btn btn-primary">
                    sub_image&hellip; <input type="file" name = "sub_image1" style="display: none;" onchange="alert('파일 업로드 성공');">
                </label>

                <label class="btn btn-primary">
                    sub_image&hellip; <input type="file" name = "sub_image2" style="display: none;" onchange="alert('파일 업로드 성공');">
                </label>

                <label class="btn btn-primary">
                    sub_image&hellip; <input type="file" name = "sub_image3" style="display: none;" onchange="alert('파일 업로드 성공');">
                </label>

                <label class="btn btn-primary">
                    sub_image&hellip; <input type="file" name = "sub_image4" style="display: none;" onchange="alert('파일 업로드 성공');">
                </label>
            </div>
         
      

            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10"> 
                    <button type="submit" class="btn btn-default">글 쓰기</button>
                    <a href = "/design_board" style = "color:black"><button type="button" class="btn btn-default">돌아가기</a></button>
                </div> 
            </div>


            
        </form>
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