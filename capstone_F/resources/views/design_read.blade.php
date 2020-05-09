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
//------------- 추천 알고리즘 ----------------
$rank = calc($d_page,$d_boards);
//------------- ------------- ---------------
?>
@section('style')
<link rel="stylesheet" type="text/css" href="/css/design_read.css">
<link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="/dist/jquery.simple-popup.min.css" rel="stylesheet" type="text/css">               
@endsection
@section('head')    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    
    <script src="/dist/jquery.simple-popup.min.js"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
    <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
@endsection
    

    
    
@section('contents')
<div>
    <div id="jb-container">
        <div class='bigPictureWrapper'>
		    <div class='bigPicture'>
		    </div>
	    </div>
        <img src="/design_image/{{ $d_page->id }}/main_image.jpg" alt="..." style = "width:100%;height:400px;">
        <br>
        <br>
        <br>
        <p class="text-left">번호:{{ $d_page->id }}</p>
        <p class="text-left">작성자:{{ $d_page->user_id }}</p>
        <p class="text-left">작성일:{{ $d_page->date }}</p>
        <br>
        <hr>
        <h2>제작한 디자인</h2>

        <img src="/design_image/{{ $d_page->id }}/sub_image1.jpg" alt="..." class="img-thumbnail" style = "width:242px;height:220px;" onerror="this.onerror=null; this.src='/board_image/default_image.jpg';">
        <img src="/design_image/{{ $d_page->id }}/sub_image2.jpg" alt="..." class="img-thumbnail" style = "width:242px;height:220px;" onerror="this.onerror=null; this.src='/board_image/default_image.jpg';">
        <img src="/design_image/{{ $d_page->id }}/sub_image3.jpg" alt="..." class="img-thumbnail" style = "width:242px;height:220px;" onerror="this.onerror=null; this.src='/board_image/default_image.jpg';">
        <img src="/design_image/{{ $d_page->id }}/sub_image4.jpg" alt="..." class="img-thumbnail" style = "width:242px;height:220px;" onerror="this.onerror=null; this.src='/board_image/default_image.jpg';">

        
        <br><br>
        <h2 style = "text-align:center;">세부 내용</h2>
        <textarea class="form-control" rows="40" name = "description" style = "width:700px; background-color:#FFF; border:0" readonly>{{ $d_page->content}}></textarea>
        <br>
        <h2 style = "text-align:center;">추가 내용</h2>
        <textarea class="form-control" rows="7" style = "width:700px; background-color:#868ㄷ96; border:0" readonly>{{ $d_page->subcontent }}</textarea>

        </div>
            
              <?php
            if($_SESSION['id'] == $d_page->user_id)
            {
            ?>
             <div class="form-group" style = "margin-left : 170px;margin-top:20px;">
                <div class="col-sm-offset-2 col-sm-10"> 
                     <a href = "{{ route('design_delete', ['d_page' => $d_page->id]) }}"><button type="button" class="btn btn-danger">글 삭제</button></a>
                    <a href = "/design_board"><button type="button" class="btn btn-info">돌아가기</button></a>
                </div> 
            </div>

            
            <?php
            }
            ?>

            <?php if($_SESSION['id'] != $d_page->user_id)
            {
            ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10"> 
                    <a href = "/board" style = "color:white;"><button type="button" class="btn btn-info">돌아가기</button></a>
                </div> 
            </div>
            <?php
            }
            ?>

        <div style="clear:both; display: flex;justify-content: center;margin-bottom:100px;">
        <a href = "#" class = "demo-2"><button type="button" class="btn btn-primary">디자인 요청</button></a>
        </div>
    <!------------------------------ new - 추천 목록----------------------------------------------->        
    <div id="div-right">
        <h3> 추천 </h3>
        
        <?php 
        for($i = 0 ; $i<count($rank) ; $i++){
        ?>
        <a href = "{{ route('design_read', ['d_page' => $rank[$i]]) }}">
            <img class="jumbotron" src="/design_image/<?php echo $rank[$i]?>/main_image.jpg" alt="..."style = "width:300px;"   >
        </a>
        <?php 
        }
        ?>
    </div> 
    <!------------------------------- --- ----------------------------------------------->
</div>
@endsection                
<script>
function resize(obj) {
  obj.style.height = "1px";
  obj.style.height = (12+obj.scrollHeight)+"px";
}
</script>    

<!-- 팝업 시작 -->
@section('popup')
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
        
    <script type="text/javascript">
	$(document).ready(function (e){
		
		$(document).on("click","img",function(){
			var path = $(this).attr('src')
			showImage(path);
		});//end click event
		
		function showImage(fileCallPath){
		    
		    $(".bigPictureWrapper").css("display","flex").show();
		    
		    $(".bigPicture")
		    .html("<img src='"+fileCallPath+"' >")
		    .animate({width:'100%', height: '100%'}, 1000);
		    
		  }//end fileCallPath
		  
		$(".bigPictureWrapper").on("click", function(e){
		    $(".bigPicture").animate({width:'0%', height: '0%'}, 1000);
		    setTimeout(function(){
		      $('.bigPictureWrapper').hide();
		    }, 1000);
		  });//end bigWrapperClick event
	});
</script>    
    
    
    
@endsection            
            
@section('form1')
      <div id="popup2">
            <h2>Design requset form</h2>
            <br>
            <form action = "/design_form" method = "POST">
     {{ csrf_field() }}
                <div class="form-group">
                <input type = "hidden" name = "board_no" value = {{ $d_page->id }}>
                <input type = "hidden" name = "designer_id" value = {{ $d_page->user_id }}>
                <input type = "hidden" name = "applicant" value = <?php echo $_SESSION['id']?>>
                    <label for="exampleInputEmail1">사용 용도</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name = "u_pou" aria-describedby="emailHelp" placeholder="사용 용도 입력">
                    <small id="IdHelp" class="form-text text-muted">사용 용도를 입력 해주세요</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">직업</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name = "u_job" placeholder="직업 입력">
                    <small id="IdHelp" class="form-text text-muted">현재 직업 입력 해주세요</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">디자인 정보</label>
                    <br>
                    <small id="IdHelp" class="form-text text-muted">템플릿에 추가할 사항을 체크 해주세요</small>
                    <br>
                <label class="radio-inline">
                    <input type="checkbox" name="info[]"  value="이름 필요">이름
                </label>
                <label class="radio-inline">
                    <input type="checkbox" name="info[]"  value="연락처 필요">연락처
                </label>
                <label class="radio-inline">
                    <input type="checkbox" name="info[]"  value="이메일 필요">이메일
                </label>
                <label class="radio-inline">
                    <input type="checkbox" name="info[]"  value="직책 필요">직책
                </label>
                <label class="radio-inline">
                    <input type="checkbox" name="info[]"  value="주소 필요">주소
                </label>
                <label class="radio-inline">
                    <input type="checkbox" name="info[]"  value="직책 필요">단체명
                </label>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">요청사항</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name = "u_moredetails" aria-describedby="emailHelp" placeholder="그외 요청 사항">
                    <small id="IdHelp" class="form-text text-muted">그외 요청할 사항들을 적어주세요</small>
                </div>
    
                    <button type="submit" style = "margin-top:10px; background-color:#01DFA5; border:none;"class="btn btn-primary">디자인 요청</button>
            </form>
         </div>
                        
                        
                        
                        
@endsection            
            
    
@section('bottom')
 
@endsection

<!-- new simm ---------------------------------- 추천 알고리즘 -->
@section('simm')
<?php
function calc($no,$db){
        $item;
        $other = array();
        $recomend = array();
        $sql2 = $db;
        $vector_count=0;
        $rank= array();
        $rank_max= 3; 
        $rank_count=0;
        $id = array();
        $id_count=0;
        
        foreach ($sql2 as $sql){
            
                $id[$id_count] = $sql->id;
            
            $id_count++;
        }
        
        foreach ($sql2 as $sql){
            $other[$vector_count] = $sql->vector;
            if($sql->id == $no->id)
            {
                $item=$sql->vector;
            }
            $vector_count++;
        }
        
        for($i = 0; $i<count($other); $i++)
        {
            $score_count= 0;
            if($id[$i]!=$no->id)
            {
                for($j = 0; $j<count($other); $j++)
                {
                    if($i!=$j)
                    {
                        $sim_Sel= sim_u($item, $other[$i]);
                        $sim_Oth= sim_u($item, $other[$j]);
                        if($sim_Sel>$sim_Oth)
                        {
                            $score_count++;
                        }
                    } 
                }
                $recomend[$i] = $score_count;
            }else{
                $recomend[$i]=10000;
            }
        }
        
        
        for($e=0;$e<=$rank_max;$e++){

            for($k=0;$k<count($recomend);$k++)
            {
                if($recomend[$k]==$e){
                    $rank[$rank_count]=$id[$k];
                    $rank_count++;
                }
                if(count($rank)>=$rank_max)
                {
                    break;
                }
            }
        }
        
        
        return $rank;
    }

    function sim($item,$other){//코사인

        $split_item=0; //배열로 나눔
        $split_other=0; //배열로 나눔
        $result = 0; //유사도

        $pow_1=0;$pow_2=0; //제곱

        $mult=0; //곱셈

        $sqrt_1=0;$sqrt_2=0; //제곱근

        $split_item = str_split($item);
        $split_other = str_split($other);

        for($i=0; $i<count($split_item);$i++)
        {
            $pow_1 += pow($split_item[$i],2);
            $pow_2 += pow($split_other[$i],2);

            $mult += $split_item[$i]*$split_other[$i];
        }

        $sqrt_1 = sqrt($pow_1);
        $sqrt_2 = sqrt($pow_2);

        $result = $mult/($sqrt_1*$sqrt_2);

        return $result;
    }



    function sim_u($item, $other){//유클리디안
        $split_item=0; //배열로 나눔
        $split_other=0; //배열로 나눔
        $result = 0; //유사도

        $pow_r=0; //제곱


        $sqrt_r=0; //제곱근

        $split_item = str_split($item);
        $split_other = str_split($other);

        for($i=0; $i<count($split_item);$i++)
        {
            $pow_r += pow($split_item[$i]-$split_other[$i],2);

        }

        $sqrt_r = sqrt($pow_r);

        $result = $sqrt_r;

        return $result;
    }

?>
@endsection
<!-- ------ ---------------------------------- ----- ----- -->