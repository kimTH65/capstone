@extends('Mainlayout')
<?php session_start(); $list_nick?> <!-- 세션 전역에서 사용 -->

@section('title','Main - 君の名刺は')
    
@section('user')
    <!-- 세션 시작 -->
<?php
    if(!empty($home)) 
    {
        $_SESSION['idx'] = $home->user_no;
        $_SESSION['id'] = $home->user_id;
        $_SESSION['pw'] = $home->user_pw;
        $_SESSION['job'] = $home->user_job;
        $_SESSION['nick'] = $home->user_nick;
    }
?>
@endsection
    
@section('style')
    <link rel="stylesheet"  type="text/css" href="css/top_popup.css"/>
    <link href="dist/jquery.simple-popup.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
    
   
@endsection    
    
@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="dist/jquery.simple-popup.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>    
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
    
@endsection    
@section('contents')
<!-- 중단 시작 -->  
        <middle>
            <div  class="" style="height: auto; padding-bottom: 40px;background-image: url('main_img/back_blue.png'); background-repeat: no-repeat; background-position: center;background-size: cover; " >
                <div class="" style="height: 70%">
                    <div id="myCarousel" class="carousel slide " data-ride="carousel" >

                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="main_img/advertisement-216908_1280.jpg" alt="" style="width: 100%; opacity: 0.5;">
                            <div class="carousel-caption ">
                                <a style="font-size:5rem;font-family:serif; color:white;font-weight: bolder;">君の名刺は</a>
                            </div>
                        </div>
                        <div class="item" >
                            <img src="main_img/advertisement-216909_1280.jpg" alt=""  style="width: 100%; opacity: 0.5;">
                            <div class="carousel-caption">
                               <a style="font-size:5rem;font-family:serif; color:white;font-weight: bolder;">君の名刺は</a>
                            </div>
                        </div>
                        <div class="item" >
                            <img src="main_img/credit-squeeze-522549_1280.jpg" alt=""  style="width: 100%; opacity: 0.5;">
                            <div class="carousel-caption">
                                <a style="font-size:5rem;font-family:serif; color:white;font-weight: bolder;">君の名刺は</a>
                            </div>
                        </div>
                    </div>
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <hr>
                <div class="container marketing" >
                    <div class="row featurette" style="margin:50px;">
                        <div class="col-md-7" >
                            <a style="font-size:8rem; color: white; font-family:serif; font-weight: bolder;">君の名刺は</a>
                            <h2 class="featurette-heading" style="font-size:5rem; font-weight:bolder;">무엇을 제공 하는가.</h2>
                            <br>
                            <div class="lead" style="font-size:2rem; font-family:serif; font-weight: bold"> 연락처를 <strong style="color:gainsboro">직접 제작</strong> 할 수 있습니다. </div>
                            <div class="lead" style="font-size:2rem; font-family:serif; font-weight: bold"> 연락처를 <strong style="color:gainsboro">간편하게 관리</strong> 할 수 있습니다.  </div>
                            <div class="lead" style="font-size:2rem; font-family:serif; font-weight: bold"> 연락처를 <strong style="color:gainsboro">의뢰, 거래</strong> 할 수 있습니다.</div>
                        </div>
                        <div class="col-md-5" style="margin-top: 60px;">
                            <img class="main_img/featurette-image img-responsive center-block"  alt="500x500" src="main_img/card.jpg">
                        </div>
                    </div>

                    <hr>

                    <div class="row" style="margin-top:50px; margin-bottom: 50px;" >
                        <div class="col-lg-4 ">
                            <img class="main_img/img-circle center-block jumbotron" src="main_img/in1.jpg" width="180" height="180" style="padding: 10px;">
                            <h2 style="font-size:3rem; font-weight:bolder; text-align: center;">연락처 제작하기</h2>
                            <p style="text-align:center;font-weight: bold;"> 자신을 소개 할 수 있는 연락처를 <br>직접 만들어 보세요.</p>
                        </div>
                        
                        <div class="col-lg-4">
                            <img class="main_img/img-circle center-block jumbotron" style="padding: 10px;" src="main_img/in2.jpg" width="180" height="180">
                            <h2 style="font-size:3rem; font-weight:bolder; text-align: center;">연락처 관리</h2>
                            <p style="text-align:center;font-weight: bold;">자신의 연락처, 혹은 타인의 연락처를 <br> 간편하게 관리 할 수 있습니다.</p>
                        </div>
                        
                        <div class="col-lg-4">
                            <img class="main_img/img-circle center-block jumbotron" style="padding: 10px;" src="main_img/in3.jpg" width="180" height="180">
                            <h2 style="font-size:3rem; font-weight:bolder; text-align: center;">디자인 요청</h2>
                            <p style="text-align:center;font-weight: bold;">연락처의 제작이 어려우시면 <br>디자이너에게 요청을 해보세요.<p>
                         </div>
                    </div>

                    <hr>
                    
                    <div class="row featurette" style="margin-top: 50px;">
                        
                        <div class="row-md-7 ">
                            <p style="font-size:5rem; font-weight:bolder;color: white; text-align: center; margin-bottom: 30px; ">
                                앱으로 사용해 <br>보세요</p>
                        </div>
                        
                     
                    </div>

                     
                    
                    <div class="row featurette" style="">
                        
                        <div class="center-block">
                            <h1 style="font-weight:border; font-size:5rem ;color: window;"></h1><br>
                        </div>
                        
                        <div style="marign-top:50px;">
                            <div class="col-md-3 " >
                                <img class="main_img/featurette-image img-responsive center-block jumbotron "  
    
                                    src="template/main1.jpg" style="padding: 10px; height: 400px; "  >
                            </div>
                            <div class="col-md-3 ">
                                <img class="main_img/featurette-image img-responsive center-block jumbotron"  
                                    src="template/main2.jpg"  style="padding: 10px; height: 400px;">
                            </div>
                            <div class="col-md-3 ">
                                <img class="main_img/featurette-image img-responsive center-block jumbotron" 
                                    src="template/main3.jpg"  style="padding: 10px; height: 400px;">
                            </div>
                            <div class="col-md-3 ">
                                <img class="main_img/featurette-image img-responsive center-block jumbotron" 
                                    src="template/main4.jpg"  style="padding: 10px; height: 400px;"   >
                            </div>
                            
                        </div>
                    </div>

                    <hr>

                    <p class="pull-right"><a href="#" style="color: white;" >상단으로 이동</a></p>
                    
                </div>
            </div>
        </middle>                            
<!-- 중단 끝 -->    
@endsection
                                                       
@section('form1')
        <div id="popup1">
            <h2>Signup Form</h2>
               
            <br>
            <form action = "/signup" method = "POST">
                            {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">아이디</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name = "uId" aria-describedby="emailHelp" placeholder="Enter ID">
                    <small id="IdHelp" class="form-text text-muted">아이디를 입력 해주세요</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">비밀번호</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name = "uPass" placeholder="Enter Password">
                        <small id="IdHelp" class="form-text text-muted">비밀번호를 입력 해주세요</small>
                </div>
                        
                        
                <div class="form-group">
                    <label for="NickName">닉네임</label>
                    <input type="text" class="form-control" id="NickName" name = "uNick" placeholder="Enter Nickname">
                    <small id="NicHelp" class="form-text text-muted">닉네임을 입력 해주세요</small>
                </div>
                    <label class="radio-inline">
                    <input type="radio" name="Job"  value="designer"> 디자이너
                    </label>
                    <label class="radio-inline">
                    <input type="radio" name="Job"  value="normal"> 일반
                    </label>
                    <br>
                    <button type="submit" style = "margin-top:10px; background-color:#01DFA5; border:none;"class="btn btn-primary">가입하기</button>
            </form>
         </div>                            
@endsection
                        
@section('form2')
<div id="popup2">
            <h2>Login Form</h2>
            <br>
            <form action = "/" method = "POST">
                        {{ csrf_field() }}
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
                        
@section('form3')
<?php if(!empty($_SESSION['id']))
{
 ?>
<div id="popup3">
            <h2>User Information</h2>
            <br>
            <form action = "/">
                        {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputEmail1">아이디</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name = "uId" aria-describedby="emailHelp" value = <?php echo $_SESSION['id']?>  readonly >
                    <small id="IdHelp" class="form-text text-muted">현재 로그인한 사용자의 아이디입니다.</small>
                </div>
                        
                <div class="form-group">
                    <label for="exampleInputNickname">닉네임</label>
                    <input type="text" class="form-control" id="exampleInputNickname" name = "uNick" value = <?php echo $_SESSION['nick']?>  readonly >
                    <small id="IdHelp" class="form-text text-muted">현재 로그인한 사용자의 닉네임입니다.</small>
                </div>
                        
                <div class="form-group">
                    <label for="exampleInputJob">회원 구분</label>
                    <input type="text" class="form-control" id="exampleInputJob" name = "uJob" value = <?php echo $_SESSION['job']?>  readonly >
                    <small id="IdHelp" class="form-text text-muted">현재 로그인한 사용자의 회원 구분입니다.</small>
                </div>

                    <button type="button" style = "margin-top:10px; background-color:#01DFA5; border:none;"class="btn btn-primary">확인</button>
            </form>
         </div>     
<?php
                        }
?>
@endsection
    
    
@section('form4')
<?php 
if(!empty($_SESSION['id']))
    {
        if($list_nicks = DB::table('card_list')->where('user_id', $_SESSION['id'])->pluck('opponent'))
        {
 ?>
<div id="popup4">
            <h2>User Information</h2>
            <br>
            <form action = "/message" method = "POST">
                        {{ csrf_field() }}
    <strong>쪽지 보낼 상대</strong><br>
               
            <select name='nick'>
                <?php
                foreach ($list_nicks as $list_nick) 
                {
                ?>
              <option value=<?php echo $list_nick?>><?php echo $list_nick?></option>
                    <?php
                    }
    ?>
            </select>
        <br><br>
                <div class="form-group">
                    <label for="Message">쪽지 내용</label>
                    <input type="text" class="form-control" id="Message" name = "Message" placeholder="Enter Message">
                    <small id="Message" class="form-text text-muted">전달할 내용을 입력 해주세요</small>
                </div>
                <input type="hidden" id="userid" name="userid" value=<?php echo $_SESSION['id']?>>
                <br>
                  <button type="submit" style = "margin-top:10px; background-color:#01DFA5; border:none;"class="btn btn-primary">전송</button>
            </form>
         </div>     
<?php
        }
    }

?>
@endsection    
    

@section('bodybottom')
  <foot>
            <div class="row-md-3" style="height: auto;background: #333333;">    
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
                        
<!-- 팝업 시작 -->
@section('popup')
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
         <script src="dist/jquery.simple-popup.min.js"></script>
         <script>
            $(document).ready(function() {
            $("a.demo-2").simplePopup({ type: "html", htmlSelector: "#popup2" });
            $("a.demo-3").simplePopup({ type: "html", htmlSelector: "#popup3" });
            $("a.demo-1").simplePopup({ type: "html", htmlSelector: "#popup1" });
            $("a.demo-4").simplePopup({ type: "html", htmlSelector: "#popup4" });
            
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

             
@endsection             
                            