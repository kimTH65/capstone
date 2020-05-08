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
$id = $_SESSION['id'];


// 설정한 대표 템플릿이 있는지 데이터를 불러옴 있다면 타입과 이미지 이름을 불러옴.
 if($repre = DB::table('repre_imgs')->where('user_id', $id)->first())
 {
    $type = $repre->type;
    $img_name = $repre->img_name;
 }
else
{
    $type = "없음";
}
// 템플릿 테이블에도 저장된 데이터가 있는지 불러오고 아이디를 저장함
if($user = DB::table('template_tables')->where('user_id', $id)->first())
{
    $user_id = $user->user_id;
}
else
{
    $user_id = "없음";
}
// 사용자가 만든 템플릿이 있는지 디렉토리를 검사함
    try
    {
        $result=opendir("UserUploads/".$id);  //opendir함수를 이용해서 bbs디렉토리의 핸들을 얻어옴
        $file_count = 0;


         // readdir함수를 이용해서 디렉토리에 있는 디렉토리와 파일들의 이름을 배열로 읽어들임
         while($file=readdir($result)) 
         {
            if($file=="."||$file=="..") {continue;} // file명이 ".", ".." 이면 무시함
            $fileInfo = pathinfo($file);
            $fileExt = $fileInfo['extension']; // 파일의 확장자를 구함

            if(!empty($fileExt))
            {
                $file_count = $file_count + 1;// 파일에 확장자가 있으면 file_count를 증가시킴
            } 
            else 
            {

            }
         }
     
    }// 만약 디렉토리가 없다면 무료 템플릿은 만들었는지 체크를 함
    catch(Exception $e)
    {
        if($user = DB::table('template_tables')->where('user_id', $id)->first())
        {
            $user_id = $user->user_id;
            $file_count = 0;
        }
        else // 저장된 템플릿이 아무것도 없다면 저장된 템플릿이 없다는 예외 처리를 하며 메인으로 보냄
        {
            goto_caution("저장된 템플릿이 없습니다.","/");
        }
        //goto_caution("저장된 템플릿이 없습니다.","/");
    }

?>    
    
@section('head')
 <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        <link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
@endsection
    
    
@section('style')
<link rel="stylesheet" type="text/css" href="css/TemplatePage.css">    
@endsection   
    

@section('contents')
  
      <script>
     $(document).ready(function()
        {
            $("#testchange").click(function()
            {
                $("#test_1").html(test.value);
            });
        });
    </script>
<div id="jb-container">
        <ul class="nav nav-tabs" >
            <li role="presentation"><a href="/MyTemplate" style  = "color:#01DFA5;" >대표 템플릿</a></li>
            <li role="presentation"><a href="#"  onclick="Basetem();" >기본 템플릿</a></li>
            <li role="presentation"><a href="#"  onclick="Mytem();" >내 템플릿</a></li>
         
  

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
            function Basetem()
            {
                $("#MyRepre").empty();
                $("#Mytem").empty();
                var str = "";
                var id = '<?php echo $_SESSION['id'] ?>';
                var check_id = '<?php echo $user_id?>';

                document.getElementById("Basetem").innerHTML = "";


                if(id == check_id)
                {
                    str +=  "<form action = '/MyTemplate_process' method = 'POST'>";
                    str +=  "<div id = 'jb-imagebox'>";
                    str +=  "<button type='submit' style = 'margin-left:5px;margin-bottom:5px;background-color:#01DFA5; width:100%;border:none;'class='btn btn-primary'>대표 연락처로 설정</button>";
                    //str +=  "<a href = template_page/TemplatePage/Mytemplate"+i+".php>";
                    str +=  "<a href = 'http://34.217.179.54/template_page/Mytemplate/myTemplate1.php'>";
                    str += "<img src='template/text/text_im1.jpg' alt = template/tem1.jpg style = 'width:250px; height:420px;'></img></a>";
                    str +=  "<input type='hidden' name='_token' value='{{ csrf_token() }}'>";
                    str +=  "<input type='hidden' id = 'base_number' name='base_number' value='text_im1.jpg'>";
                    str +=  "<input type='hidden' id = 'base_im'  name='base_im' value='text'>";
                    str +=  "<input type='hidden' id = 'base_id'  name='base_id' value="+id+">";
                    str +=  "</div>";
                    str +=  "</form>";
                    document.getElementById("Basetem").innerHTML = str;
                }
                else
                {}
            }

            function Mytem()
            {
                $("#MyRepre").empty();
                $("#Basetem").empty();
                var str = "";
                var id = '<?php echo $id ?>';
                var count = '<?php echo $file_count ?>';
               
                document.getElementById("Mytem").innerHTML = "";
                var cnt = 1;
                if(count >= 1)
                {
                    for(var i = 1; i<=count;i++)
                    {
                        str +=  "<form action = '/MyTemplate_process' method = 'POST'>";
                        
                        str +=  "<div id = 'jb-imagebox'>";
                        str +=  "<button type='submit' style = 'margin-left:5px;margin-bottom:5px;background-color:#01DFA5; width:100%;border:none;'class='btn btn-primary'>대표 연락처로 설정</button>";
                        //str +=  "<a href = template_page/TemplatePage/Mytemplate"+i+".php>";
                        str +=  "<a href = '#' >";
                        str += "<img src='UserUploads/"+id+"/"+i+".jpg' alt = template/tem1.jpg style = 'width:250px; height:420px;'></img></a>";
                        str +=  "<input type='hidden' name='_token' value='{{ csrf_token() }}'>";
                        str +=  "<input type='hidden' id = 'base_im'  name='base_im' value=base>";
                        str +=  "<input type='hidden' id = 'base_number'  name='base_number' value="+i+".jpg>";
                        str +=  "<input type='hidden' id = 'base_id'  name='base_id' value="+id+">";
                        str +=  "</div>";
                        str +=  "</form>";
        
                        document.getElementById("Mytem").innerHTML = str;
                    }
                    
                }
                else
                {}
            }
        	


      
               
    </script>
        
        <div id = "MyRepre">
            <div id = 'jb-imagebox'>
            <?php 
            if($type == "base")
            {
            ?>
                <button type='submit' style = 'margin-left:5px;margin-bottom:5px;background-color:#01DFA5; width:100%;border:none;'class='btn btn-primary' disabled>대표 연락처</button>
                <img src='UserUploads/<?php echo $id?>/<?php echo $img_name?>' alt = template/tem1.jpg style = 'width:250px; height:420px;'></img>
            <?php
            }
            else if($type == "text")
            {
            ?>
            <button type='submit' style = 'margin-left:5px;margin-bottom:5px;background-color:#01DFA5; width:100%;border:none;'class='btn btn-primary' disabled>대표 연락처</button>
            <img src='template/text/<?php  echo $img_name?>' alt = template/tem1.jpg style = 'width:250px; height:420px;'></img>
            <?php
            }
            ?>
    </div>

        </div>

        <div id = "Mytem">
           
        </div>

        <div id = "Basetem">
       
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
   <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
          <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
          <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
@endsection 
                
                
                