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
    <link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="dist/jquery.simple-popup.min.css" rel="stylesheet" type="text/css">       
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
    <script src="dist/jquery.simple-popup.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection    
    

    
@section('contents')
        <?php if($_SESSION['job'] === 'normal')
        {
            $design_status = DB::table('design_forms')->where('design_form_applicant',$_SESSION['id'])->get();
        }
        else if($_SESSION['job'] === 'designer')
        {
            $design_status = DB::table('design_forms')->where('design_form_designer',$_SESSION['id'])->get();
        }
        ?>
    <div id="jb-container">
        <p style="font-size:5rem; font-weight:bolder;text-align:center;">디자인 요청 상황</p>
    <img src="main_img/design_sta.jpg" alt = "다지인요청이미지" style = "width:900px;"><br><br>
       @foreach ($design_status as $status)
        <form action = "/design_form_process" method = "POST">
     {{ csrf_field() }}
        
      <div class="list-group">
      <a href="#" class="list-group-item">
        <h4 class="list-group-item-heading">디자인 상황</h4>
        <p class="list-group-item-text">디자이너 : {{ $status->design_form_designer }} <br></p>
        <p class="list-group-item-text">신청자 : {{ $status->design_form_applicant }}<br>
        <p class="list-group-item-text">상세 사항 : {{ $status->design_form_detail }}<br>
        <p class="list-group-item-text">이름 : {{ $status->design_form_name }}<br>
        <p class="list-group-item-text">연락처 : {{ $status->design_form_phone }}<br>
        <p class="list-group-item-text">이메일 : {{ $status->design_form_email }}<br> 
        <p class="list-group-item-text">직책 : {{ $status->design_form_position }}<br>
        <p class="list-group-item-text">주소 : {{ $status->design_form_address }}<br>
        <p class="list-group-item-text">단체명 : {{ $status->design_form_group }}<br>
        <p class="list-group-item-text">현재상태 : {{ $status->design_form_progress }}<br>
            
        <input type = "hidden" name = "board_no" value = {{ $status->design_form_boar_no }}>
        <input type = "hidden" name = "applicant" value = {{ $status->design_form_applicant }}>
        <input type = "hidden" name = "progess" value = {{ $status->design_form_progress }}>
      </a>
    </div>
    <button type="submit" style = "margin-top:10px; background-color:#01DFA5; border:none;"class="btn btn-primary">{{ $status->design_form_progress }} 상태 입니다</button>
            <br><br>
   </form>
<?php if($status->design_form_progress === '요청')
{
       $width = 'width:0%';
}?>
<?php if($status->design_form_progress === '수락')
{
       $width = 'width:20%';
}?>
<?php if($status->design_form_progress === '제작')
{
       $width = 'width:50%';
}?>
<?php if($status->design_form_progress === '완료')
{
       $width = 'width:80%';
}?>
<?php if($status->design_form_progress === '거래완료')
{
       $width = 'width:100%';
}?>    
  <div class="progress">
  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style=<?php echo $width?>>
    <span class="sr-only">Complete</span>
  </div>
</div>

            
            
         @endforeach
    
            
     <div class="text-center">
            <ul class="pagination justify-content-center">
                
       {{ $form_pages->links() }}
         </ul>
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