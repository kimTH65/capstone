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

@section('head')    
  <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
      
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
    
@section('style')
<link rel="stylesheet" type="text/css" href="../css/read.css">
@endsection
    
    
@section('contents')
    <middle>
        <div id="jb-container">
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="/question_image/mini.png" alt="..."  style = "width:970px;">
      <div class="carousel-caption">
        ...
      </div>
    </div>
      
    <div class="item">
      <img src="/question_image/mini2.jpg" alt="..."  style = "width:970px;">
      <div class="carousel-caption">
        ...
      </div>
    </div>
      
    <div class="item">
    <img src="/question_image/mini3.png" alt="..."  style = "width:970px;">
      <div class="carousel-caption">
        ...
      </div>
     </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
      
      <hr>


        <br><br><br><br>
        <div id="text-body">
        <form action = "/q_comment_process" method = "POST" class="form-horizontal" role="form"  enctype="multipart/form-data"> 
            {{ csrf_field() }}
            <div class="form-group"> 
                <label for="title" class="col-sm-2 control-label">제목</label> 
                 <div class="col-sm-10"> 
                 <input type="text" class="form-control" name = "title" style="width:400px; background-color:white;" id="title" readonly value = {{ $q_page->title }}>
                </div> 
            </div> 

            <div class="form-group"> 
                 <label for="user" class="col-sm-2 control-label">작성자</label>
                    <div class="col-sm-10"> 
                     <input type="text" class="form-control" name = "user" style = "width : 150px;"id="user" readonly value = {{ $q_page->user_id }}>
                    </div>
            </div>

            <div class="form-group"> 
                 <label for="author" class="col-sm-2 control-label">내용</label>
                    <div class="col-sm-10"> 
                    <textarea class="form-control" rows="20" name = "description" style = "width:700px; background-color:white;" readonly>{{ $q_page->content }}</textarea>
                    </div>
            </div>
                     
                     <div class="" style=" float: right; margin-top:10px; ">
        <?php if($q_page->file!=""){?>
        <img src="/board_image/".$q_page->file."png"; class="" style="height: 300px; width: 300px; ">
        <?php }?>
        </div>

                     
                      <?php
            if($_SESSION['id'] == $q_page->user_id)
            {
            ?>
             <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10"> 
                <a href = "{{ route('question_update', ['q_page' => $q_page->id]) }}"<button type="button" class="btn btn-primary">글 수정</button></a>
                     <a href = "{{ route('question_delete', ['q_page' => $q_page->id]) }}"><button type="button" class="btn btn-danger">글 삭제</button></a>
                    <a href = "/question_board"><button type="button" class="btn btn-info">돌아가기</button></a>
                </div> 
            </div>

            
            <?php
            }
            ?>

            <?php if($_SESSION['id'] != $q_page->user_id)
            {
            ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10"> 
                    <a href = "/board" style = "color:white;"><button type="button" class="btn btn-info">돌아가기</button></a>
                </div> 
            </div>
            <?php
            }
            ?>
                
                <div class="form-group">

           @foreach ($q_reply as $q_replys)
                <label for="comment" class="col-sm-2 control-label">{{ $q_replys->name }}</label>
                      <div class="col-sm-10"> 
                        
                        <textarea class="form-control" rows="4" style = "width:500px;background-color:white;border:none;resize: none;box-shadow: 0px 0px 2px rgba(0,0,0,.8);" readonly>{{ $q_replys->content }}</textarea>
                        작성일 {{$q_replys->created_at }}
                         <a href = "{{ route('q_co_delete', ['q_reply' => $q_replys->id]) }}">글 삭제</a>
               
                    <br><br><br>
                    </div>
               
             @endforeach  
        </div>

        <hr>

            <div class="form-group"> 
                <input type ="hidden" name ="board_no" value = {{ $q_page->id }}>
                <input type ="hidden" name ="user_id" value = {{ $_SESSION['id'] }}>
                 <label for="author" class="col-sm-2 control-label">댓글작성</label>
                    <div class="col-sm-10"> 
                    <textarea class="form-control" rows="5" name = "content" style = "width:400px;resize: none; background-color:white;"></textarea>
                    <br><button type="submit" class="btn btn-info">글 쓰기</button>
                    </div>
            </div>
           

            
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
 <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>  
@endsection