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
<link rel="stylesheet" type="text/css" href="../css/TemplatePage_1.css">

@endsection       
    
@section('head')    
<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        
        <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
     
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    
    <script src="/dist/jquery.simple-popup.min.js"></script>
    
    
<link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
    <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
@endsection
 
    

@section('contents')
<script>
         $(document).ready(function()
        {
            $("#toptitle_change").click(function()
            {
                $("#top_title").html(toptitle_text.value);
            });
        });

        $(document).ready(function()
        {
            $("#title_change").click(function()
            {
                $("#title_name").html(title_text.value);
            });
        });

        $(document).ready(function()
        {
            $("#st_change").click(function()
            {
                $("#st_title").html(small_title.value);
            });
        });

        $(document).ready(function()
        {
            $("#intro_change").click(function()
            {
                $("#body_title").html(intro_text.value);
            });
        });

        $(document).ready(function()
        {
            $("#memo_change").click(function()
            {
                $("#body_name").html(memo_text.value);
            });
        });



        $(document).ready(function()
        {
            $("#tel_change").click(function()
            {
                $("#tel").html(tel_text.value);
            });
        });

        $(document).ready(function()
        {
            $("#email_change").click(function()
            {
                $("#email").html(email_text.value);
            });
        });

        $(document).ready(function()
        {
            $("#fax_change").click(function()
            {
                $("#fax").html(fax_text.value);
            });
        });

        $(document).ready(function()
        {
            $("#infotitle_change").click(function()
            {
                $("#infotitle").html(info_title.value);
            });
        });

        $(document).ready(function()
        {
            $("#infotext_change").click(function()
            {
                $("#info_name").html(info_text.value);
            });
        });



  

       
        </script>
            
<div id="jb-container">
    <div id = "jb-header2">
    <form action = "/template_page/TemplatePage_image_upload" method = "POST">
            @csrf
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne"style = "background-color:white;height:65px;box-shadow: 2px 2px 3px 3px #F5F5F5;">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <h4>STEP 1. 이름 및 직책 입력</h4>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
            
            <input type = "hidden" value = "<?php echo $_SESSION['id'];?>" name = "user_id">
    <label class="control-label" for="toptitle_text">Input TopTitle</label>
    <input type="text" class="form-control" id="toptitle_text" name = "toptitle_text"aria-describedby="inputSuccess2Status">
    <button type="button"id = "toptitle_change" style = "margin-top:5px;"class="btn btn-info">입력하기</button>
    <br>
    <br>
    <label class="control-label" for="title_text">Input Title</label>
    <input type="text" class="form-control" id="title_text" name = "title_text" aria-describedby="inputSuccess2Status">
    <button type="button"id = "title_change" style = "margin-top:5px;"class="btn btn-info">입력하기</button>
    <br>
    <br>
    <label class="control-label" for="small_title">Input SmallTitle</label>
    <input type="text" class="form-control" id="small_title" name = "small_title"aria-describedby="inputSuccess2Status">
    <button type="button"id = "st_change" style = "margin-top:5px;"class="btn btn-info">입력하기</button>
  </div>
    </div>
  </div>
        <br>
        
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo" style = "background-color:white;height:65px;box-shadow: 2px 2px 3px 3px #F5F5F5;">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <h4>STEP 2. 자기소개 입력</h4>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">

    <label class="control-label" for="intro_text">Input Introduction</label>
    <input type="text" class="form-control" id="intro_text" name = "intro_text" aria-describedby="inputSuccess2Status">
    <button type="button"id = "intro_change" style = "margin-top:5px;"class="btn btn-info">입력하기</button>
    <br><br>


    <h4>Input Memo</h4>
    <br>
    <textarea id = "memo_text" rows="8" cols="41" style="border:0"  name = "memo_text" placeholder="내용을 입력해 주세요"></textarea>
    <br>
    <button type="button"id = "memo_change" style = "margin-top:5px;"class="btn btn-info">입력하기</button>

   </div>
    </div>
  </div>
        <br>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree" style = "background-color:white;height:65px;box-shadow: 2px 2px 3px 3px #F5F5F5;">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <h4>STEP 3. 이메일, 전화번호, 팩스번호 입력</h4>
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
    
    <label class="control-label" for="tel_text">Input PhoneNumber</label>
    <input type="text" class="form-control" id="tel_text" name = "tel_text1" aria-describedby="inputSuccess2Status">
    <button type="button"id = "tel_change" style = "margin-top:5px;"class="btn btn-info">입력하기</button>
    <br><br>

    <label class="control-label" for="email_text">Input Email</label>
    <input type="text" class="form-control" id="email_text" name = "tel_text2" aria-describedby="inputSuccess2Status">
    <button type="button"id = "email_change" style = "margin-top:5px;"class="btn btn-info">입력하기</button>
    <br><br>
    <label class="control-label" for="fax_text">Input FaxNumber</label>
    <input type="text" class="form-control" id="fax_text" name = "tel_text3" aria-describedby="inputSuccess2Status">
    <button type="button"id = "fax_change" style = "margin-top:5px;"class="btn btn-info">입력하기</button>
 
        
        </div>
    </div>
  </div>
        <br>
        
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour" style = "background-color:white;height:65px;box-shadow: 2px 2px 3px 3px #F5F5F5;">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <h4>STEP 4. 상세내용 입력</h4>
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">

   

    <label class="control-label" for="info_title">Input Info_Title</label>
    <input type="text" class="form-control" id="info_title" name = "info_title" aria-describedby="inputSuccess2Status">
    <button type="button"id = "infotitle_change" style = "margin-top:5px;"class="btn btn-info">입력하기</button>
    <br><br>
    <h4>Input Memo</h4><br>
    <textarea id = "info_text" rows="8" cols="41" style="border:0" name = "info_text" placeholder="내용을 입력해 주세요"></textarea><br>
    <button type="button"id = "infotext_change" style = "margin-top:5px;"class="btn btn-info">입력하기</button>

  </div>
    </div>
  </div>
        <br>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFive" style = "background-color:white;height:65px;box-shadow: 2px 2px 3px 3px #F5F5F5;">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          <h4>STEP 5. 주소입력 및 저장</h4>
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">




    <label class="control-label" for="lo_title">Input Location</label>
    <input type="text" class="form-control" id="lo_title" name = "lo_title" aria-describedby="inputSuccess2Status">
    <br><br>
    <input class="btn btn-default" type="submit" value="submit">
    </div>
    <form>
        
     </div>
    </div>
  </div>

</div>
    <h1 style = "color:#01DFA5;">Create a Simple User Template</h1>
    <h6>홈페이지에서 제공하는 무료 템플릿을 이용해 템플릿을 만들어보세요!</h6>
    <div id="jb-content">
        <div class="Title_img">
        <img src="../image_template1/title_image.jpg" alt="test" style = "width:100%; height:300px;" >
            <div class="content">
             <?php if((empty($template_user)))
                   {
            ?>
            <h1 id = "title_name" style = "display:inline;color:white;margin-top:20;">홍 길 동</h1><small id = "st_title" style = "font-size:20px;color:#999999;">학생</small>
            <?php 
                 }
                   else
                   {
             ?>
                <h1 id = "title_name" style = "display:inline;color:white;">{{$template_user->template_title_text }}</h1><small id = "st_title" style = "font-size:20px;color:#999999;">{{$template_user->template_title_small }}</small>
               <?php
                    }
                ?>
         
            </div>
            <div class = "content2">
            <?php if((empty($template_user)))
                   {
            ?>
            <h1 id = "top_title"  style = "color:white;">영진전문대학교</h1>
            <?php }
                  else
                  {
             ?>
                 <h1 id = "top_title" style = "color:white;">{{$template_user->template_title }}</h1>
                 <?php
                      }
                     ?>
                         
            </div>
            <div class="img-cover"></div>
        </div>

        <div class="body_img">
        <img src="../template1/body.jpg" alt="test" style = "width:100%; height:300px;" >
            <div class="body_content">
              <?php if((empty($template_user)))
               {
               ?>
            <textarea id = "body_name" rows="8" cols="40" style="border:0" readonly ></textarea>
              <?php
               }
                else
                {
               ?>
                   <textarea id = "body_name" rows="8" cols="40" style="border:0;" readonly >{{$template_user->template_memo_text }}</textarea>
                 <?php
                 }
                ?>
            </div>
            <div class = "body_content2">
              <?php if((empty($template_user)))
               {
               ?>
            <h1 id = "body_title" style = "color:white;">Introduction</h1>
              <?php
               }
               else
               {
               ?>
               <h1 id = "body_title" style = "color:white;">{{$template_user->template_intro_text }}</h1>    
                <?php
                 }
                  ?>
                  
            </div>
            <div class="body_cover"></div>
        </div>

        

        <div class="tel-img" style = "box-shadow: 1px 1px 3px 3px #F5F5F5;height:100px;">
            <img src="../template1/tel.jpg" id = "title_images"alt="tel" class="img-rounded" style = "width:50px;margin-top:25px;margin-left:20px;">
                <div class="tel-content">
                 <?php if((empty($template_user)))
               {
               ?>     
                    <h2 id = "tel">010-1234-1234</h2>
                <?php
                 }
                  else
                  {
                 ?>
                     <h2 id = "tel">{{$template_user->template_tel }}</h2>
                  <?php
                      }
                    ?>
                     
                </div>
                <div class="tel-cover"></div>
        </div>

        <div class="tel-img" style = "box-shadow: 1px 1px 3px 3px #F5F5F5;height:100px;">
            <img src="../template1/email.png" id = "title_images"alt="email" class="img-rounded" style = "width:50px;margin-top:25px;margin-left:20px;">
                <div class="tel-content">
                <?php if((empty($template_user)))
               {
               ?>             
                    <h2 id = "email">abcdef@naver.com</h2>
                <?php
                }
               else
               {
               ?>
                <h2 id = "email">{{$template_user->template_email }}</h2>
               <?php
               }
                ?>
                   
                </div>
                <div class="tel-cover"></div>
        </div>

        <div class="tel-img" style = "box-shadow: 1px 1px 3px 3px #F5F5F5;height:100px;">
            <img src="../template1/fax.png" id = "title_images"alt="fax" class="img-rounded" style = "width:50px;margin-top:25px;margin-left:20px;">
                <div class="tel-content">
                <?php if((empty($template_user)))
                   {
                   ?>          
                    <h2 id = "fax">053-940-5338</h2>
                  <?php
                    }
                    else
                    {
                   ?>
                    <h2 id = "fax">{{$template_user->template_fax }}</h2>
                    <?php
                    }
                    ?>
                </div>
                <div class="tel-cover"></div>
        </div>

        <div id = "info" style = "padding:10px;">
        <?php if((empty($template_user)))
        {
        ?>
            <h2 id = "infotitle">Information</h2>
        <?php
         }
         else
         {
         ?>
             <h2 id = "infotitle">{{$template_user->template_info_title }}</h2>
         <?php
         }
         ?>
         <?php if((empty($template_user)))
            {
            ?>
        <textarea id = "info_name" rows="8" cols="65" style="border:0" readonly>Twitter, Inc.  795 Folsom Ave, Suite 600</textarea>
      <?php
           }
           else
           {
       ?>
                <textarea id = "info_name" rows="8" cols="65" style="border:0" readonly>{{$template_user->template_info_text }}</textarea>
     <?php        
           }
        ?>
 

       
        <div class="map_wrap">
    <div id="map" style="width:100%;height:350px;position:relative;overflow:hidden;"></div>

    <div id="menu_wrap" class="bg_white">
        <div class="option">
            <div>
                <form onsubmit="searchPlaces(); return false;">
             <?php if((empty($template_user)))
            {
            ?>
                    키워드 : <input type="text" value="이태원 맛집" id="keyword" size="15"> 
             <?php
             }
              else
              {
             ?>
                        키워드 : <input type="text" value="{{$template_user->template_location }}" id="keyword" size="15"> 
                            <?php
                  }
                ?>
                </form>
            </div>
        </div>
        <hr>
        <ul id="placesList"></ul>
        <div id="pagination"></div>
    </div>
</div>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=f34eff267ef6e287b59a6e1796628602&libraries=services"></script>
<script>
// 마커를 담을 배열입니다
var markers = [];

var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = {
        center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };  

// 지도를 생성합니다    
var map = new kakao.maps.Map(mapContainer, mapOption); 

// 장소 검색 객체를 생성합니다
var ps = new kakao.maps.services.Places();  

// 검색 결과 목록이나 마커를 클릭했을 때 장소명을 표출할 인포윈도우를 생성합니다
var infowindow = new kakao.maps.InfoWindow({zIndex:1});

// 키워드로 장소를 검색합니다
searchPlaces();

// 키워드 검색을 요청하는 함수입니다
function searchPlaces() {

    var keyword = document.getElementById('keyword').value;

    if (!keyword.replace(/^\s+|\s+$/g, '')) {
        alert('키워드를 입력해주세요!');
        return false;
    }

    // 장소검색 객체를 통해 키워드로 장소검색을 요청합니다
    ps.keywordSearch( keyword, placesSearchCB); 
}

// 장소검색이 완료됐을 때 호출되는 콜백함수 입니다
function placesSearchCB(data, status, pagination) {
    if (status === kakao.maps.services.Status.OK) {

        // 정상적으로 검색이 완료됐으면
        // 검색 목록과 마커를 표출합니다
        displayPlaces(data);

        // 페이지 번호를 표출합니다
        displayPagination(pagination);

    } else if (status === kakao.maps.services.Status.ZERO_RESULT) {

        alert('검색 결과가 존재하지 않습니다.');
        return;

    } else if (status === kakao.maps.services.Status.ERROR) {

        alert('검색 결과 중 오류가 발생했습니다.');
        return;

    }
}

// 검색 결과 목록과 마커를 표출하는 함수입니다
function displayPlaces(places) {

    var listEl = document.getElementById('placesList'), 
    menuEl = document.getElementById('menu_wrap'),
    fragment = document.createDocumentFragment(), 
    bounds = new kakao.maps.LatLngBounds(), 
    listStr = '';
    
    // 검색 결과 목록에 추가된 항목들을 제거합니다
    removeAllChildNods(listEl);

    // 지도에 표시되고 있는 마커를 제거합니다
    removeMarker();
    
    for ( var i=0; i<places.length; i++ ) {

        // 마커를 생성하고 지도에 표시합니다
        var placePosition = new kakao.maps.LatLng(places[i].y, places[i].x),
            marker = addMarker(placePosition, i), 
            itemEl = getListItem(i, places[i]); // 검색 결과 항목 Element를 생성합니다

        // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
        // LatLngBounds 객체에 좌표를 추가합니다
        bounds.extend(placePosition);

        // 마커와 검색결과 항목에 mouseover 했을때
        // 해당 장소에 인포윈도우에 장소명을 표시합니다
        // mouseout 했을 때는 인포윈도우를 닫습니다
        (function(marker, title) {
            kakao.maps.event.addListener(marker, 'mouseover', function() {
                displayInfowindow(marker, title);
            });

            kakao.maps.event.addListener(marker, 'mouseout', function() {
                infowindow.close();
            });

            itemEl.onmouseover =  function () {
                displayInfowindow(marker, title);
            };

            itemEl.onmouseout =  function () {
                infowindow.close();
            };
        })(marker, places[i].place_name);

        fragment.appendChild(itemEl);
    }

    // 검색결과 항목들을 검색결과 목록 Elemnet에 추가합니다
    listEl.appendChild(fragment);
    menuEl.scrollTop = 0;

    // 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
    map.setBounds(bounds);
}

// 검색결과 항목을 Element로 반환하는 함수입니다
function getListItem(index, places) {

    var el = document.createElement('li'),
    itemStr = '<span class="markerbg marker_' + (index+1) + '"></span>' +
                '<div class="info">' +
                '   <h5>' + places.place_name + '</h5>';

    if (places.road_address_name) {
        itemStr += '    <span>' + places.road_address_name + '</span>' +
                    '   <span class="jibun gray">' +  places.address_name  + '</span>';
    } else {
        itemStr += '    <span>' +  places.address_name  + '</span>'; 
    }
                 
      itemStr += '  <span class="tel">' + places.phone  + '</span>' +
                '</div>';           

    el.innerHTML = itemStr;
    el.className = 'item';

    return el;
}

// 마커를 생성하고 지도 위에 마커를 표시하는 함수입니다
function addMarker(position, idx, title) {
    var imageSrc = 'http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_number_blue.png', // 마커 이미지 url, 스프라이트 이미지를 씁니다
        imageSize = new kakao.maps.Size(36, 37),  // 마커 이미지의 크기
        imgOptions =  {
            spriteSize : new kakao.maps.Size(36, 691), // 스프라이트 이미지의 크기
            spriteOrigin : new kakao.maps.Point(0, (idx*46)+10), // 스프라이트 이미지 중 사용할 영역의 좌상단 좌표
            offset: new kakao.maps.Point(13, 37) // 마커 좌표에 일치시킬 이미지 내에서의 좌표
        },
        markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imgOptions),
            marker = new kakao.maps.Marker({
            position: position, // 마커의 위치
            image: markerImage 
        });

    marker.setMap(map); // 지도 위에 마커를 표출합니다
    markers.push(marker);  // 배열에 생성된 마커를 추가합니다

    return marker;
}

// 지도 위에 표시되고 있는 마커를 모두 제거합니다
function removeMarker() {
    for ( var i = 0; i < markers.length; i++ ) {
        markers[i].setMap(null);
    }   
    markers = [];
}

// 검색결과 목록 하단에 페이지번호를 표시는 함수입니다
function displayPagination(pagination) {
    var paginationEl = document.getElementById('pagination'),
        fragment = document.createDocumentFragment(),
        i; 

    // 기존에 추가된 페이지번호를 삭제합니다
    while (paginationEl.hasChildNodes()) {
        paginationEl.removeChild (paginationEl.lastChild);
    }

    for (i=1; i<=pagination.last; i++) {
        var el = document.createElement('a');
        el.href = "#";
        el.innerHTML = i;

        if (i===pagination.current) {
            el.className = 'on';
        } else {
            el.onclick = (function(i) {
                return function() {
                    pagination.gotoPage(i);
                }
            })(i);
        }

        fragment.appendChild(el);
    }
    paginationEl.appendChild(fragment);
}

// 검색결과 목록 또는 마커를 클릭했을 때 호출되는 함수입니다
// 인포윈도우에 장소명을 표시합니다
function displayInfowindow(marker, title) {
    var content = '<div style="padding:5px;z-index:1;">' + title + '</div>';

    infowindow.setContent(content);
    infowindow.open(map, marker);
}

 // 검색결과 목록의 자식 Element를 제거하는 함수입니다
function removeAllChildNods(el) {   
    while (el.hasChildNodes()) {
        el.removeChild (el.lastChild);
    }
}
</script>

<script>
  // 스크린샷 부분
 function showPopup() { window.open("toolPage.php", "a", "width=400, height=300, left=100, top=50"); }

    var $btn = document.getElementById('btnScreenShot');
    $btn.addEventListener('mousedown', onScreenShotClick);



function onScreenShotClick(ev)
{ //스크린샷 기능
    setTimeout(function() {

  html2canvas(document.querySelector("#jb-content")).then(canvas => 
  {
    saveAs(canvas.toDataURL('image/jpg'),"capture-test.jpg");
  }); }, 10000);

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


    </div>

        





    </div>            
            
            
            
    
@endsection    
    
    
    
@section('bottom')
 <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
          <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
          <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
    
          <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="http://code.jquery.com/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>    
@endsection