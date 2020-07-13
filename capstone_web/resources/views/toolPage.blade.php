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
<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    
    <script src="/dist/jquery.simple-popup.min.js"></script>
    
    
<link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
    <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
    
    
        
        <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
        
        <script src = "https://cdn.rawgit.com/eligrey/FileSaver.js/5ed507ef8aa53d8ecfea96d96bc7214cd2476fd2/FileSaver.min.js"></script>
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>
      
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    
     <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
          <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
          <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
@endsection    
    
@section('style')
<link rel="stylesheet" type="text/css" href="css/toolPage.css">    
@endsection    

    
    

@section('contents')
<script> // 오른쪽 편집툴 스크롤바 따라가는 부분
      $(document).ready(function() {
      // 기존 css에서 플로팅 배너 위치(top)값을 가져와 저장한다.
      var floatPosition = parseInt($("#jb-header2").css('top'));
      // 250px 이런식으로 가져오므로 여기서 숫자만 가져온다. parseInt( 값 );
      $(window).scroll(function() {
        // 현재 스크롤 위치를 가져온다.
        var scrollTop = $(window).scrollTop();
        var newPosition = scrollTop + floatPosition + "px";
        /* 애니메이션 없이 바로 따라감
        $("#floatMenu").css('top', newPosition);
        */
        $("#jb-header2").stop().animate({
          "top" : newPosition
        }, 400);

      }).scroll();

      });
    </script>
    <script>
            var target = null;
            var startX = null;
            var startY = null;
            var startLeft = null;
            var startTop = null;
            var move = false;
            var reM = false;
            var count = 1;
            var fixing = false;
            
            var textStr ='<textarea name="textBox" id="textBox" class="textBox"   onclick ="handleRemove(this),handleFixText(this)" onmousedown="handleMouseDown(event)"></textarea>';    
            //var imgStr ='<div id="imgDiv" name="imgDiv"><img src="'+imgSrc+'" class="imgC" id="img" name="img"/></div>';
            

        function cleaner()
        {  // 텍스트 지우기
                if(this.reM == true)
                {
                    this.reM = false;
                    $("#cleaner").text("Delete");
                }
                else if(this.reM == false){
                    this.reM = true;
                    $("#cleaner").text("Cancel");
                }
            }
            function handleRemove(e) //텍스트 지우기
            {
                if(reM==true)
                {
                    $(e).remove();
                }
            }

            function handleFixText(e) //텍스트 수정
            {
                this.$selectText = $(e);
                
                var fontSize = document.getElementById("fontSize");
                var fontName = document.getElementById("fontName");
                var fontWeight = document.getElementById("fontWeight");
                var fontColor = document.getElementById("fontColor");
                
                fontSize.value = $(e).css('font-size');
                fontName.value = $(e).css('font-family');
                fontWeight.value = $(e).css('font-weight');
                fontColor.value = $(e).css('color');
               
            }
            
            function changeFont(e){ //폰트 사이즈
                $(this.$selectText).css('font-size',e.value);
            }
            function changeFamily(e){ //폰트 선택
                $(this.$selectText).css('font-family',e.value);
            }
            function changeWeight(e){ //폰트 굵기 
                $(this.$selectText).css('font-weight',e.value);
            }
            function changeColor(e){ //폰트 컬러
                $(this.$selectText).css('color',e.value);
            }

            function fix(){ //텍스트 테두리 
                
                if(this.fixing==true)
                {
                    this.fixing=false;
                    $("#fix").text("Hide border");
                    $(".textBox").css("border","1px solid black");
                    $(".textBox").css("resize","");
                }
                else if(this.fixing==false)
                {
                    this.fixing=true;
                    $("#fix").text("Show border");
                    $(".textBox").css("border","none");
                    $(".textBox").css("resize","none");
                }
                
            }
            
            
	//텍스트 박스 생성
            function createText(){
                $("#jb-content").append('<p>' + textStr + '</p>');
            }


            
	//이미지 생성
            function createImage()
            {
                var upload = document.getElementById("image");
                var file = upload.files[0];
                var reader = new FileReader();
                
                reader.onload = function(e)
                {
                    var img = new Image();
                    img.src = event.target.result;
                    img.setAttribute('id',"img"+count+"");
                    img.setAttribute('class','imgC');
                    img.setAttribute('name','img');
                    img.setAttribute('onclick','handleRemove(this)');
                    img.width = 100;
                    img.height = 100;
                    $("#jb-content").append(img);
                    $("img[id^='img"+count+"']").wrap("<div name='imgDiv' class='imgDiv'/>");
                    count++;
                    
                    $(document).ready(function() 
                    {
                        $("img[name^='img']").resizable();
                        $("div[name^='imgDiv']").draggable();        
                    });
                }
                reader.readAsDataURL(file);
            }
            
	      //텍스트 박스 움직일 때 사용
          function moveM()
          { //텍스트 이동/크기조절
                if(this.move == true)
                {
                    this.move = false;
                    $("#move").text("Move");
                }
                else if(this.move == false)
                {
                    this.move = true;
                    $("#move").text("Resize");
                }
            }
            
	//텍스트 박스 움직일 때 사용
            function handleMouseDown(event) 
            {
                // 시작 위치 등 저장
                if(this.move == true)
                {
                    target = event.target;
                    startX = event.clientX;
                    startY = event.clientY;
                    startLeft = target.offsetLeft;
                    startTop = target.offsetTop;
                    // 마우스 무브, 업 이벤트 리스너 할당
                    document.addEventListener('mousemove', handleMouseMove);
                    document.addEventListener('mouseup', handleMouseUp);
                }
            }
            
	//텍스트 박스 움직일 때 사용
            function handleMouseMove(event) 
            {
                // 현재 마우스 포인터 위치와 시작 위치를 이용해 계산
                var CURRENTX = event.clientX;
                var CURRENTY = event.clientY;
                var DELTAX = CURRENTX - startX;
                var DELTAY = CURRENTY - startY;
                // 계산된 위치 값을 타겟에 설정
                target.style.left = (startLeft + DELTAX) + 'px';
                target.style.top= (startTop + DELTAY) + 'px';
            }

            //텍스트 박스 움직일 때 사용
            function handleMouseUp(event) 
            {
                document.removeEventListener('mousemove', handleMouseMove);
                document.removeEventListener('mouseup', handleMouseUp);
            }
      </script>

            <ul class="side-menu" style = "z-index: 2;"> <!-- 왼쪽 메뉴바 -->
            <li><a href="#"><span class="fa fa-code"></span>君の名刺は</a></li>
            <li><a href="#" class = "left-pop" data-content="<h1>도움말</h1><br>Text Toolbar, Image Toolbar를 이용해서 나만의 연락처(명함)을 만들어보세요!<br>도움이 필요할 경우 메뉴바 밑에 있는 버튼을 클릭하세요!"><span class="fa fa-bars"></span>도움말</a></li>
            <li><a href="#" class = "left-pop" data-content="<h1>Text Toolbar</h1><br>1. Text : TextBar를 생성합니다. <br> 2. Move : 텍스트 혹은 이미지를 움직입니다. <br> 3. Delete : 이미지 혹은 텍스트를 삭제합니다. <br> 4. Size : 글씨 크기를 조절합니다. <br> 5. Color : Text Color를 설정합니다. <br> 6. Font : Text 폰트를 설정합니다. 7. Font_Weight : 텍스트 굵기를 설정합니다. <br> 8. Border Show/Hide : Text의 border를 보여주거나 없앱니다."><span class="fa fa-bars"></span>Text Toolbar</a></li>
            <li><a href="#" class = "left-pop" data-content="<h1>Image Capture</h1><br>스크롤바를 상단에 위치한 뒤, <br>Image Capture를 누르면 연락처(명함)이 JPG 파일로 저장됩니다."><span class="fa fa-bars"></span>Image Capture</a></li>
            <li><a href="#" class = "left-pop" data-content="<h1>Image Upload</h1><br>1. Image Toolbar에서 Files를 눌러 이미지를 선택합니다. <br>2. Image Upload를 누르면 웹 페이지에 이미지가 업로드 됩니다."><span class="fa fa-bars"></span>Image Upload</a></li>
            <li><a href="#" class = "left-pop" data-content="<h1>Save Image</h1><br>1. Image Toolbar에서 Save Image를 누른다음 Browse를 눌러 이미지를 선택합니다. <br>2. 이미지 업로드 성공 이라는 팝업창이 뜬 다음, Submit을 누르면 내가 만든 연락처(명함)에 저장이 됩니다."><span class="fa fa-bars"></span>Save Image</a></li>
            </ul>
<div id="jb-container">
      <div id="jb-header">
        <h2>연락처 템플릿</h2>
      </div>
      <div id="jb-header2">
      <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Text Toolbar</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><button type = "button" class="btn btn-default btn-sm" onclick="createText()">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Text</button>
        </li>
        <li><button type = "button" id = "move" class="btn btn-default btn-sm" onclick="moveM()">
        <span class="glyphicon glyphicon-text-width" aria-hidden="true"></span>Move</li>
        <li><button type = "button" class="btn btn-default btn-sm" onclick="cleaner()" id="cleaner">
        <span class="glyphicon glyphicon-remove" aria-hidden="true">Delete</span></li>
        <li><button type = "button" class="btn btn-default btn-sm">
        <span class="glyphicon glyphicon-text-size" aria-hidden="true" ></span>Size</li>
        <li><input type="text" id="fontSize" style = "width:40px;height:30px;"onchange="changeFont(this)" /><br></li>
        <li><button type = "button" class="btn btn-default btn-sm" style = "height:30px;">
        <span class="glyphicon glyphicon-text-color" aria-hidden="true"></span>Color</li>
        <input type="color"style = "width:30px; height:29px; margin-top :5px;margin-left : 2px;" id="fontColor" onchange="changeColor(this)" /><br>
        <input type="color" style = "height:29px; margin-left : 2px; margin-top :5px;" onchange="document.querySelector('#jb-content').style.backgroundColor=this.value">
        <li><button type = "button" class="btn btn-default btn-sm left">
        <span class="glyphicon glyphicon-font" aria-hidden="true"></span>Font</li>
        <li>
          <select name="Name" id="fontName" style = "height:30px;"onchange="changeFamily(this)">
            <option value="cursive">cursive</option>
            
            <option value="serif">serif</option>
            <option value="sans-serif">sans-serif</option>
            <option value="monospace">monospace</option>
            <option value="fantasy">fantasy</option>
            <option value="initial">initial</option>
         </select>
      </li>

      <li><button type = "button" class="btn btn-default btn-sm left">
        <span class="glyphicon glyphicon-bold" aria-hidden="true"></span>Font-Weight</li>
        <li>
        <select name="Weight" id="fontWeight" style = "height:30px; "onchange="changeWeight(this)">
            <option value="bolder">bolder</option>
            <option value="normal">normal</option>
            <option value="lighter">lighter</option>
         </select>
      </li>

      <li><button type = "button" class="btn btn-default btn-sm left" style = "margin-bottom:5px;"  onclick="fix()" id="fix">
        <span class="glyphicon glyphicon-scissors" aria-hidden="true" onclick="fix()" id="fix"></span> Border Show/Hide</li>
      
        
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

  
</nav>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Image Toolbar</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <label class="btn btn-primary" for="image">
            <input id="image" type="file" multiple="multiple" style="display:none"
              onchange="$('#upload-file-info').html(
               (this.files.length > 1) ? this.files.length + ' files' : this.files[0].name)">                     
               Files&hellip;
            </label>
            <span class='label label-info' id="upload-file-info"></span>
        </li>
        <li><button type="button" class="btn btn-info" onclick="createImage()">이미지 삽입</button></li>
        <li><button id = "btnScreenShot" type="button" class="btn btn-success" style = "width : 185px;">연락처 템플릿화</button></li>
       <a class="demo-1 btn btn-primary" style = "margin-top:5px;margin-left:3px; margin-bottom:7px;" data-content="Lorem ipsum dolor sit amet, consectetur adipiscing elit. ">연락처 저장</a>
      
      </ul>
</nav>

      </div>
      <div id="jb-content">
       
        
    </div>
    </div>

      <div id="popup1">
         <h2>Image Upload</h2>
          <form action = "/searchDir" method = "POST" enctype="multipart/form-data">
                @csrf
          <div class="col-lg-6 col-sm-6 col-12">
                <input type = "hidden" value = "<?php echo $_SESSION['id']?>" name = "user_id">
                <h4>Upload to server</h4>
                <label class="btn btn-primary">
                    Browse&hellip; <input type="file" name = "upload" style="display: none;" onchange="alert('파일 업로드 성공');">
                </label>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
      </div>    
    
    
@endsection 
                        
@section('form1')
 <script>
      //팝업 창 부분
$(document).ready(function() 
{
  $("a.left-pop").simplePopup();
  $("a.demo-1").simplePopup({ type: "html", htmlSelector: "#popup1" });
});
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() 
  {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
// 팝업 끝
</script>                        
                                               
@endsection

@section('form2')
<script>
  // 스크린샷 부분
 function showPopup() { window.open("toolPage.php", "a", "width=400, height=300, left=100, top=50"); }

    var $btn = document.getElementById('btnScreenShot');
    $btn.addEventListener('mousedown', onScreenShotClick);


function onScreenShotClick(ev)
{ //스크린샷 기능
  html2canvas(document.querySelector("#jb-content")).then(canvas => 
  {
    saveAs(canvas.toDataURL('image/jpg'),"capture-test.jpg");
  });

    function saveAs(uri, filename) 
    {
      // 캡쳐된 파일을 이미지 파일로 내보낸다.
      var link = document.createElement('a');
      if (typeof link.download === 'string')
      {
      link.href = uri;
      link.download = filename;
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      } 
      else 
      {
      window.open(uri);
      }
    }
}
</script>    
    
@endsection     
    
    
@section('bottom')

          
          <!-- 텍스트, 이미지 추가 움직이기-->
       <script src="http://code.jquery.com/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

      <!-- 팝업 -->
      <link href="dist/jquery.simple-popup.min.css" rel="stylesheet" type="text/css">
      <script src="dist/jquery.simple-popup.min.js"></script>
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection    
    