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
    <link rel="stylesheet"  type="text/css" href="css/design_board.css">
    
    


<link href="/dist/jquery.simple-popup.min.css" rel="stylesheet" type="text/css">       
        
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

      }
  .carousel-inner{
  width:100%;
  max-height: 500px !important;
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

<div class="container marketing" style="min-height: 1000px;">
    
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox" >
    <div class="item active">
      <img src="design_image/design_sta.jpg" alt="..."  style = "width:100%;">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="design_image/design.jpg" alt="..."  style = "width:100%;">
      <div class="carousel-caption">
        ...
      </div>
    </div>
      
      <div class="item">
    <img src="design_image/design2.jpg" alt="..."  style = "width:100%;">
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
    
    
    <br><br>
      <hr>
    
  
  @foreach ($d_pages as $d_page)
  <div style = " ">
     <div class="row " style = "float:left; margin-left:30px; width:330px;margin-top:50px;">
        <div class="col-md-12 col-sm-12" >
           <div class="thumbnail">
     
    <a href = "{{ route('design_read', ['d_page' => $d_page->id]) }}"<p><img src="design_image/{{ $d_page->id }}/main_image.jpg" style = "width:270px;height:250px;margin-top:10px;"></p></a>

            <div class="caption">
               <h3>{{ $d_page->title }}</h3>
                
                <p>작성자 :{{ $d_page->user_id }}</p>
                <p>작성일 : {{ $d_page->date }}</p>
                <!-- ---------new -->
 
                <?php 
                $vect = array();
                $vect = str_split($d_page->vector);
                    
                if($vect[intval($_SESSION['idx'])-1]!=1)
                {
                ?>
                
                <a href = "{{ route('design_vector', ['user_id'=>$_SESSION['id'],'d_page' => $d_page->id,'vector_score' => $d_page->vector, 'score' => 1 ])}}"><button type="button" class="btn btn-primary">좋아요</button></a>
                <?php
                } else {
                ?>
                
                <a href = "{{ route('design_vector', ['user_id'=>$_SESSION['id'],'d_page' => $d_page->id,'vector_score' => $d_page->vector, 'score' => 0  ])}}"><button type="button" class="btn btn-primary">좋아요 취소</button></a>
                <?php
                }
                ?>
                
                <!-- ---------new -->
            </div>
            </div>
        </div>
        </div>
     </div> 
   @endforeach
    
    <?php if($_SESSION['job'] === 'designer')
    {
    ?>
     <div style="clear:both; display: flex;justify-content: center;">
        <a href = "/design_write"><button type="button" class="btn btn-primary">글쓰기</button></a>
        </div>
    <?php } ?>

  <div class="text-center">
            <ul class="pagination justify-content-center">
                
       {{ $d_pages->links() }}
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
    

                        
@section('form2')
 <div id="popup2">
            <h2>Login Form</h2>
            <br>
            <form action = "login_process.php" method = "POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">아이디</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name = "uId" aria-describedby="emailHelp" placeholder="Enter ID">
                    <small id="IdHelp" class="form-text text-muted">아이디를 입력 해주세요</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">비밀번호</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name = "uPass" placeholder="Enter Password">
                </div>

                    <button type="submit" style = "margin-top:10px; background-color:#01DFA5; border:none;"class="btn btn-primary">로그인</button>
            </form>
         </div>   
@endsection      
    
    
    
    
<!-- 팝업 시작 -->
@section('popup')
    
         <script>
            $(document).ready(function() {
            $("a.demo-2").simplePopup({ type: "html", htmlSelector: "#popup2" });
            $("a.demo-1").simplePopup({ type: "html", htmlSelector: "#popup1" });
            });
            </script>
            <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-36251023-1']);
            _gaq.push(['_setDomainName', 'jqueryscript.net']);
            _gaq.push(['_trackPageview']);

            (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
         </script>
<!-- 팝업 끝 -->
                         
@endsection    
    
    
@section('bottom')
      <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
@endsection        