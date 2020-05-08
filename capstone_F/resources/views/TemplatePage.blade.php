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
<link rel="stylesheet" type="text/css" href="css/TemplatePage.css">    
<link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
@endsection
       
@section('head')
<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        
        <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>  
@endsection
    
    

@section('contents')
<div id="jb-container">
  
        <ul class="nav nav-tabs" >
            <li role="presentation"><a href="/TemplatePage" style  = "color:#01DFA5;">Home</a></li>
            <li role="presentation" ><a href="#" style  = "color:black;"onclick = "AllTem();">All</a></li>
            <li role="presentation"><a href="#" style  = "color:black;" onclick="ImageTem();">Image Type</a></li>
            <li role="presentation"><a href="#" style  = "color:black;" onclick = "TextTem();">Text Type</a></li>

            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default" style  = "color:#01DFA5;">Submit</button>
            </form>
        </ul>
        <script>
           /* $(function() 
                {
			$("a").on("click", function() 
            {
				$("#all").empty();	// id가 "container"인 요소의 자식 요소를 모두 삭제함.
			});
		    });*/
            function AllTem()
            {
                $("#Home").empty();
                $("#TextTem").empty();
                $("#ImageTem").empty();
                var str = "";
                document.getElementById("AllTem").innerHTML = "";

                

                var Imgcount = 5;
                    for(var i = 1;i<=Imgcount;i++)
                    {
                        str +=  "<div id = 'jb-imagebox'>";
                        str +=  "<a href = /template_page/TemplatePage_"+i+">";
                        str += "<img src=template/im"+i+".jpg alt = template/im"+i+".png style = 'width:250px; height:450px;'></img></a>";
                        str +=  "</div>";
                        document.getElementById("AllTem").innerHTML = str;
                    }

                    var Textcount = 2;
                    for(var i = 1;i<=Textcount;i++)
                    {
                        str +=  "<div id = 'jb-imagebox'>";
                        str +=  "<a href = /template_page/TemplatePage_"+i+">";
                        str += "<img src=template/text/text_im"+i+".jpg alt = template/text/text_im"+i+".png style = 'width:250px; height:450px;'></img></a>";
                        str +=  "</div>";
                        document.getElementById("AllTem").innerHTML = str;
                    }
                    
            }
        	function ImageTem()
            {
                $("#Home").empty();
				$("#AllTem").empty();	// id가 "container"인 요소의 자식 요소를 모두 삭제함.
                $("#TextTem").empty();
                var str = "";
                document.getElementById("ImageTem").innerHTML = "";
                var count = 5;
                    for(var i = 1;i<=count;i++)
                    {
                        str +=  "<div id = 'jb-imagebox'>";
                        str +=  "<a href = /template_page/TemplatePage_"+i+">";
                        str += "<img src=template/im"+i+".jpg alt = template/im"+i+".png style = 'width:250px; height:450px;'></img></a>";
                        str +=  "</div>";
                        document.getElementById("ImageTem").innerHTML = str;
                    }
            }

            function TextTem()
            {
                $("#Home").empty();
                $("#AllTem").empty();
                $("#ImageTem").empty();
                var str = "";
                document.getElementById("TextTem").innerHTML = "";

                //str +=  "<div id = 'jb-imagebox'>";
                //str +=  "<a href = template_page/TemplatePage/Mytemplate"+i+".php>";
                //str +=  "<a href = template_page/TemplatePage_1.php>";
                //str += "<img src=template_page/template1/tem1.jpg alt = template/tem1.jpg style = 'width:250px; height:450px;'></img></a>";
                //str +=  "</div>";
                //document.getElementById("TextTem").innerHTML = str;

                
                var Textcount = 2;
                    for(var i = 1;i<=Textcount;i++)
                    {
                        str +=  "<div id = 'jb-imagebox'>";
                        str +=  "<a href = /template_page/TemplatePage_"+i+">";
                        str += "<img src=template/text/text_im"+i+".jpg alt = template/text/text_im"+i+".png style = 'width:250px; height:450px;'></img></a>";
                        str +=  "</div>";
                        document.getElementById("TextTem").innerHTML = str;
                    }
                    
            }


      
               
    </script>
        <div id = "Home">
        

            <div class="row featurette" style="margin-top: 50px;margin-bottom: 50px;margin-left: 10px;">         
                            <div class="col-md-7 ">
                                <p style="font-size:5rem; font-weight:bolder;color:#01DFA5;"> 템플릿을 제작</p>
                                <p style="font-size:2rem; font-">무료로 제공 되는 템플릿을 이용 해보세요!<br><br>고민 할 것 없이 보다 쉽게 제작 할 수 있습니다!</p>
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                                </p>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                </p>
                            </div>
                            <div class="col-md-4 jumbotron"  style = "margin-left:20px;background-color:white;margin-top:100px;">
                            <img class="featurette-image img-responsive center-block" src="main_img/advertisement-216909_1280.jpg" style="height:300px;"/>
                        </div>
                        </div>
                <hr>
                <div class="row" style="margin-top:50px; margin-bottom: 50px;" >
                        <div class="col-lg-4 ">
                            <img class="img-circle center-block" src="main_img/advertisement-216909_1280.jpg" width="140" height="140">
                            <h2 style="font-size:3rem; font-weight:bolder; text-align: center;">연락처 제작하기</h2>
                            <p style="text-align:center;"> 자신을 소개 할 수 있는 연락처를 <br>직접 만들어 보세요.</p>
                            <p><a class="btn btn-default center-block" href="#" role="button" style="width:100px;font-size: 2rem; ">click</a></p>
                        </div>
                        
                        <div class="col-lg-4">
                            <img class="img-circle center-block" src="main_img/advertisement-216908_1280.jpg" width="140" height="140">
                            <h2 style="font-size:3rem; font-weight:bolder; text-align: center;">연락처 관리</h2>
                            <p style="text-align:center;">자신의 연락처, 혹은 타인의 연락처를 <br> 간편하게 관리 할 수 있습니다.</p>
                            <p><a class="btn btn-default center-block" href="#" role="button" style="width:100px;font-size: 2rem;">click</a></p>
                        </div>
                        
                        <div class="col-lg-4">
                            <img class="img-circle center-block" src="main_img/card.jpg" width="140" height="140">
                            <h2 style="font-size:3rem; font-weight:bolder; text-align: center;">디자인 요청</h2>
                            <p style="text-align:center;">연락처의 제작이 어려우시면 <br>디자이너에게 요청을 해보세요.<p>
                            <a class="btn btn-default center-block" href="#" role="button" style="width:100px;font-size: 2rem;">click</a></p>
                        </div>
                    </div>

                 <hr>
                    <div class="row featurette" style="margin:50px;">
                        
                        <div class="center-block">
                        <p style="font-size:4.5rem; font-weight:bolder;">다양한 템플릿</p>
                        <br><br>
                        </div>
                        
                        <div style="marign-top:50px;">
                            <div class="col-md-3 ">
                                <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="main_img/advertisement-216909_1280.jpg"style = "height:175px;" data-holder-rendered="true">
                            </div>

                            <div class="col-md-3 ">
                                <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="main_img/advertisement-216908_1280.jpg"style = "height:175px;" data-holder-rendered="true">
                            </div>

                            <div class="col-md-3 ">
                                <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="main_img/card.jpg"style = "height:175px;" data-holder-rendered="true">
                            </div>
                            <div class="col-md-3 ">
                                <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500" src="main_img/credit-squeeze-522549_1280.jpg"style = "height:175px;" data-holder-rendered="true">
                            </div>
                            
                        </div>
                    </div>
        </div>
        
        <div id = "AllTem">

       </div>
      
        <div id = "ImageTem">
        </div>
        
        <div id = "TextTem">
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
    
    