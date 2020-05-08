@extends('Mainlayout')
<?php session_start(); ?> <!-- 세션 전역에서 사용 -->
@section('title','Main - 君の名刺は')
    
@section('user')
    <!-- 세션 시작 -->
<?php
    if(!empty($home)) 
    {
        $_SESSION['id'] = $home->user_id;
        $_SESSION['pw'] = $home->user_pw;
        $_SESSION['job'] = $home->user_job;
    }
?>
@endsection
    
@section('style')
    <link rel="stylesheet"  type="text/css" href="css/top_popup.css"/>
    <link href="dist/jquery.simple-popup.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
@endsection    
    
@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="dist/jquery.simple-popup.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>    
    
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
                            <div class="lead" style="font-size:2rem; font-family:serif; "> 연락처를 <strong style="color:gainsboro">직접 제작</strong>할 수 있습니다. </div>
                            <div class="lead" style="font-size:2rem; font-family:serif; "> 연락처를 <strong style="color:gainsboro">간편하게 관리</strong> 할 수 있습니다.  </div>
                            <div class="lead" style="font-size:2rem; font-family:serif; "> 연락처를 <strong style="color:gainsboro">의뢰, 거래</strong> 할 수 있습니다.</div>
                        </div>
                        <div class="col-md-5" style="margin-top: 60px;">
                            <img class="main_img/featurette-image img-responsive center-block"  alt="500x500" src="main_img/card.jpg">
                        </div>
                    </div>

                    <hr>

                    <div class="row" style="margin-top:50px; margin-bottom: 50px;" >
                        <div class="col-lg-4 ">
                            <img class="main_img/img-circle center-block" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="140" height="140">
                            <h2 style="font-size:3rem; font-weight:bolder; text-align: center;">연락처 제작하기</h2>
                            <p style="text-align:center;"> 자신을 소개 할 수 있는 연락처를 <br>직접 만들어 보세요.</p>
                            <p><a class="btn btn-default center-block" href="#" role="button" style="width:100px;font-size: 2rem; ">click</a></p>
                        </div>
                        
                        <div class="col-lg-4">
                            <img class="main_img/img-circle center-block" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="140" height="140">
                            <h2 style="font-size:3rem; font-weight:bolder; text-align: center;">연락처 관리</h2>
                            <p style="text-align:center;">자신의 연락처, 혹은 타인의 연락처를 <br> 간편하게 관리 할 수 있습니다.</p>
                            <p><a class="btn btn-default center-block" href="#" role="button" style="width:100px;font-size: 2rem;">click</a></p>
                        </div>
                        
                        <div class="col-lg-4">
                            <img class="main_img/img-circle center-block" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="140" height="140">
                            <h2 style="font-size:3rem; font-weight:bolder; text-align: center;">디자인 요청</h2>
                            <p style="text-align:center;">연락처의 제작이 어려우시면 <br>디자이너에게 요청을 해보세요.<p>
                            <a class="btn btn-default center-block" href="#" role="button" style="width:100px;font-size: 2rem;">click</a></p>
                        </div>
                    </div>

                    <hr>
                    
                    <div class="row featurette" style="margin-top: 50px;margin-bottom: 50px;margin-left: 50px;">
                        
                        <div class="col-md-7 ">
                            <p style="font-size:5rem; font-weight:bolder;">휴대폰으로도 사용 가능합니다.</p>
                            <p style="font-size:2rem; font-">우측에 있는 qr코드를 이용하거나,<br><br>아래의 주소를 통해서 다운로드 할 수 있습니다.</p>
                            <a href="#" style="font-size:2rem;" ><br>https://주소.~~</a>
                        </div>
                        
                        <div class="col-md-4 jumbotron" >
                            <img class="main_img/featurette-image img-responsive center-block" src="main_img/qr.png" />
                        </div>
                        
                    </div>

                    <hr>  
                    
                    <div class="row featurette" style="margin:50px;">
                        
                        <div class="center-block">
                            <h1 style="font-weight:border; font-size:5rem ;color: window;">기타 기능</h1><br>
                        </div>
                        
                        <div style="marign-top:50px;">
                            <div class="col-md-3 ">
                                <img class="main_img/featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE5MC4zMTI1IiB5PSIyNTAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MjNwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj41MDB4NTAwPC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true">
                            </div>
                            <div class="col-md-3 ">
                                <img class="main_img/featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE5MC4zMTI1IiB5PSIyNTAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MjNwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj41MDB4NTAwPC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true">
                            </div>
                            <div class="col-md-3 ">
                                <img class="main_img/featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE5MC4zMTI1IiB5PSIyNTAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MjNwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj41MDB4NTAwPC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true">
                            </div>
                            <div class="col-md-3 ">
                                <img class="main_img/featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE5MC4zMTI1IiB5PSIyNTAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MjNwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj41MDB4NTAwPC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true">
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
  <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
         
@endsection             
                            