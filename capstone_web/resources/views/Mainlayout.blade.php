  @yield('user')
@yield('simm')
<!DOCTYPE html>
      <?php
 $mAgent = array("iPhone","iPod","Android","Blackberry", 
    "Opera Mini", "Windows ce", "Nokia", "sony" );

$chkMobile = false;
for($i=0; $i<sizeof($mAgent); $i++){
    if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
        $chkMobile = true;
        break;
    }
}

?>   
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>@yield('title')</title>
    

<!-- Styles -->
  @yield('head')      
      
 <!-- top 메뉴 or 팝업창 style -->
        

   @yield('style')
    </head>
    <body>
    <!-- 상단 시작 -->
    <top>
    <nav class="navbar navbar-default" style="width: 100%">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <strong><a class="navbar-brand" href="#" style = "color:#01DFA5; margin-top:5px;">君の名刺は</a></strong>
                    </div>
        
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="http://3.87.12.253/">Home <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">소개</a></li>
                        <?php 
                        if($chkMobile == false){
                        ?>
                            <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                    aria-expanded="false">연락처 만들기 <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/TemplatePage">템플릿 불러오기</a></li>
                                <li><a href="/toolPage">나만의 연락처</a></li>
                            </ul>

                            </li>
                        <?php 
                            }
                        ?>
                        <li><a href="/design_board">디자인 요청</a></li>
                        <li><a href="/board">커뮤니티</a></li>
                        <li><a href="/question_board">문의 게시판</a></li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default" style  = "color:#01DFA5;">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            if(!isset($_SESSION['id']) && !isset($_SESSION['password']))
                            {
                         ?>
                                <li style = "margin-top:20px; color:#01DFA5;" >로그인</li>
                                <li style = "margin-top:20px;" >해주세요.</li>
                                
                        <?php
                            }
                            else
                            {
                        ?>
                            <li style = "margin-top:20px; color:#01DFA5;" ><?php echo $_SESSION['id']?></li>
                            <li style = "margin-top:20px;" >님으로 로그인 되었습니다.</li>
                        <?php
                            }
                        ?>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">회원정보 <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        <?php
                            
                            if(!isset($_SESSION['id']) && !isset($_SESSION['password']))
                            {
                        ?>
                            <li><a href = "#" class = "demo-1"  data-content="Signup">회원가입</a></li>
                            <li><a href="#" class = "demo-2">로그인</a></li>
                        <?php
                            }
                            else
                            {
                        ?>
                            <li><a href="#" class = "demo-3">사용자 정보</a></li>
                            <li><a href="#" class = "demo-4">쪽지 보내기</a></li>
                            <li><a href="/message_Status">쪽지 확인</a></li>
                            <li><a href="/MyTemplate">내 템플릿</a></li>
                            <li><a href="/design_Status">디자인 요청 상황</a></li>
                            <li><a href="logout">로그아웃</a></li>
                        <?php
                            }
                        ?>
                        </ul>
                        </li>
                    </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
                </nav>
        </top>
 <!-- 상단 끝 -->
                            
                            
@yield('contents')   
                            
                            
<!-- 하단 -->
 @yield('bodybottom')
 <!-- 하단 끝 -->
<!-- 첫 번쨰 폼 시작 -->
@yield('form1')                            
<!-- 첫번째 폼 끝 -->

<!-- 두번째 폼-->
@yield('form2')
            
<!-- 두번째 폼 끝-->
                            
<!-- 세번째 폼-->
@yield('form3')      
<!-- 세번째 폼 끝-->                            
                            
<!-- 네번째 폼-->
@yield('form4')      
<!-- 네번째 폼 끝-->   

<!-- 팝업 --> 
@yield('popup')
<!-- 팝업 끝 -->
@yield('query')  

@yield('bottom')      

    </body>
</html>
