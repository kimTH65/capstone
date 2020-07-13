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
<link href="/dist/jquery.simple-popup.min.css" rel="stylesheet" type="text/css">     
    <style>
       #jb-container 
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

      }
  .carousel-inner{
  width:100%;
  max-height: 550px !important;
}
    
    </style>
@endsection    
    
@section('head')
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    
    <script src="/dist/jquery.simple-popup.min.js"></script>
    
    
<link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
    <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
@endsection    
    

@section('contents')
<div class="container marketing" style="min-height: 1000px;" >
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
      <img src="./board_image/codesign1.jpg" alt="..."  style = "width:100%;">
      <div class="carousel-caption">
        ...
      </div>
    </div>
      
    <div class="item">
      <img src="../board_image/codesign.jpg" alt="..."  style = "width:100%;">
      <div class="carousel-caption">
        ...
      </div>
    </div>
      
    <div class="item">
    <img src="/design_image/design_sta.jpg" alt="..."  style = "width:100%;">
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
</div >
        
        
        
        
        
        <hr>
        <div >
        <table class="table table-striped">
            <thead>
                <th width = "12%">번호</th>
                <th width = "50%">제목</th>
                <th width = "15%">작성자</th>
                <th width = "30%">날짜</th>
            </thead>
            <tbody>
        @foreach ($pages as $page)
    <tr>
        <td>{{ $page->id }}</td>
    <td><a href = "{{ route('read', ['page' => $page->id]) }}"<span>{{ $page->title }}</span></a></td> 
        <td>{{ $page->user_id }}</td>
        <td>{{ $page->created_at }} </td>
    @endforeach
    </tr>
    </tbody>
    </table>
    </div>
    <div style="float: right;">
            <a href="/write"><button>글쓰기</button></a>
        </div>


  <div class="text-center">
            <ul class="pagination justify-content-center">
                
       {{ $pages->links() }}
         </ul>
    </div>
             </div>
@endsection    

    
@section('bodybottom')    
<foot>
        
        <div class="row-md-3" style="height: auto;background: #333333; clear:both;">    
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
     <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
@endsection        