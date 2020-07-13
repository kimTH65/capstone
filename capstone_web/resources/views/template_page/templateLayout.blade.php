<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>@yield('title')</title>
    

 <meta name="viewport" content="width=device-width, initial-scale=0.6">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        <link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

      
      
        
      
        
        <!--<script src = "https://cdn.rawgit.com/eligrey/FileSaver.js/5ed507ef8aa53d8ecfea96d96bc7214cd2476fd2/FileSaver.min.js"></script>-->
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>

   <style>
        .map_wrap, .map_wrap * {margin:0;padding:0;font-family:'Malgun Gothic',dotum,'돋움',sans-serif;font-size:12px;}
.map_wrap a, .map_wrap a:hover, .map_wrap a:active{color:#000;text-decoration: none;}
.map_wrap {position:relative;width:100%;height:330px;}
#menu_wrap {position:absolute;top:0;left:0;bottom:0;width:230px;margin:10px 0 30px 10px;padding:5px;overflow-y:auto;background:rgba(255, 255, 255, 0.7);z-index: 1;font-size:12px;border-radius: 10px;}
.bg_white {background:#fff;}
#menu_wrap hr {display: block; height: 1px;border: 0; border-top: 2px solid #5F5F5F;margin:3px 0;}
#menu_wrap .option{text-align: center;}
#menu_wrap .option p {margin:10px 0;}  
#menu_wrap .option button {margin-left:5px;}
#placesList li {list-style: none;}
#placesList .item {position:relative;border-bottom:1px solid #888;overflow: hidden;cursor: pointer;min-height: 65px;}
#placesList .item span {display: block;margin-top:4px;}
#placesList .item h5, #placesList .item .info {text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
#placesList .item .info{padding:10px 0 10px 55px;}
#placesList .info .gray {color:#8a8a8a;}
#placesList .info .jibun {padding-left:26px;background:url(http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/places_jibun.png) no-repeat;}
#placesList .info .tel {color:#009900;}
#placesList .item .markerbg {float:left;position:absolute;width:36px; height:37px;margin:10px 0 0 10px;background:url(http://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_number_blue.png) no-repeat;}
#placesList .item .marker_1 {background-position: 0 -10px;}
#placesList .item .marker_2 {background-position: 0 -56px;}
#placesList .item .marker_3 {background-position: 0 -102px}
#placesList .item .marker_4 {background-position: 0 -148px;}
#placesList .item .marker_5 {background-position: 0 -194px;}
#placesList .item .marker_6 {background-position: 0 -240px;}
#placesList .item .marker_7 {background-position: 0 -286px;}
#placesList .item .marker_8 {background-position: 0 -332px;}
#placesList .item .marker_9 {background-position: 0 -378px;}
#placesList .item .marker_10 {background-position: 0 -423px;}
#placesList .item .marker_11 {background-position: 0 -470px;}
#placesList .item .marker_12 {background-position: 0 -516px;}
#placesList .item .marker_13 {background-position: 0 -562px;}
#placesList .item .marker_14 {background-position: 0 -608px;}
#placesList .item .marker_15 {background-position: 0 -654px;}
#pagination {margin:10px auto;text-align: center;}
#pagination a {display:inline-block;margin-right:10px;}
#pagination .on {font-weight: bold; cursor: default;color:#777;}
        img 
        { 
            width: 100%; 
            height: auto;
        }
        .navbar
      {
        box-shadow: 1px 1px 3px 3px #F5F5F5;
        background-color : white;
      }
      li
      {
        margin-left : 3px;
        margin-top : 5px;
        float:left;
      }
      #jb-container 
      {
        width: 1240px;
        margin: 0px auto;
        padding: 10px;
        margin-top:15px;
        margin-left:130px;
        /*border: 1px solid #bcbcbc;*/
        box-shadow: 1px 1px 3px 3px #F5F5F5;
        float:left;
      }
      #jb-imagebox
      {
        width: 280px;
        height : 480px;
        margin: 55px auto;
        padding: 20px;
        float:left;
        /*border: 1px solid #bcbcbc;*/
        box-shadow: 1px 1px 3px 3px #F5F5F5;
        margin-left:20px;

      }
      #jb-content 
      {
        margin-left:50px;
        margin-top:67px;
        height : 1500px;
        width: 580px;
        float: none;
        box-shadow: 1px 1px 3px 3px #F5F5F5;
      }

      #jb-header2 
      {
        margin-top:150px;
        width: 510px;
        padding: 20px;
        margin-bottom: 45px;
        float: right;
        /*border: 1px solid #bcbcbc;*/
        position: absolute;
        margin-left : 660px;
        box-shadow: 1px 1px 3px 3px #F5F5F5;
      }
      .imgC
      {
        width: 100px;
        height: 100px;
      }
      /* 상단 부분 */
      .Title_img{
        position: relative;
        background-size: cover;
    }

    .img-cover{
       position: absolute;
       height : 150px;
       width: 150px;
       /*background-color: rgba(0, 0, 0, 0.7);*/                                                                 
       z-index:1;
    }

    .Title_img .content
    {
         position: absolute;
         top:50%;
         left:50%;
         transform: translate(-50%, 40%);                                                                   
         font-size:5rem;
         z-index: 2;
         text-align: center;
    }
    .Title_img .content2
    {
         position: absolute;
         top:50%;
         left:50%;
         transform: translate(-110%, -180%);                                                                   
         font-size:5rem;
         z-index: 2;
         text-align: center;
    }

/* 번호 부분*/
    .tel-img{
        position: relative;                                                          
        
        background-size: cover;
    }

    .tel-cover{
       position: absolute;
       height : 150px;
       width: 200px;
       /*background-color: rgba(0, 0, 0, 0.7);*/                                                                 
       z-index:1;
    }

    .tel-img .tel-content
    {
         position: absolute;
         top:50%;
         left:50%;
         transform: translate(-50%, -60%);                                                                   
         font-size:5rem;
         z-index: 2;
         text-align: center;
    }
    /* body 부분*/
    .body_img{
        position: relative;
        background-size: cover;
    }

    .body_cover{
       position: absolute;
       height : 150px;
       width: 150px;
       /*background-color: rgba(0, 0, 0, 0.7);*/                                                                 
       z-index:1;
    }

    .body_img .body_content
    {
         position: absolute;
         top:50%;
         left:50%;
         transform: translate(-50%, -34%);                                                                   
         font-size:2rem;
         z-index: 2;
        
    }
    .body_img .body_content2
    {
         position: absolute;
         top:50%;
         left:50%;
         transform: translate(-150%, -210%);                                                                   
         font-size:5rem;
         z-index: 2;
         
    }
    
    textarea
    {
        border : none;
        resize: none;
    }

   

     </style>

    
    </head>
<body onload="initialize()">
    
                            
                            
@yield('contents')   

         
@yield('script')         
         
                            
@yield('bottom')     
    </body>
</html>

         
   