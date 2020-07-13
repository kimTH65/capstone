@extends('Mainlayout')
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

      }</style>
@endsection
    
    
@section('head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    
    <script src="/dist/jquery.simple-popup.min.js"></script>
    
    
    <link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
    <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
@endsection    
    

    
@section('contents')
 <div class="container marketing" style="min-height:600px;">
        <p style="font-size:4rem; font-weight:bolder;text-align:center; width:100%;">받은 쪽지함</p>
    <img src="main_img/message.png" alt = "다지인요청이미지" style = "width:500px;margin-left:300px;"><br><br>
       @foreach ($form_pages as $status)
    <div class="list-group">
      <a href="#" class="list-group-item">
        <h4 class="list-group-item-heading">받은 쪽지</h4>
        <p class="list-group-item-text">보낸 사람 : {{ $status->user_id }} <br></p>
        <p class="list-group-item-text">메시지 내용 : {{ $status->message }} <br></p>
           </a>
    </div>
    
    
    @endforeach
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