<?php
// 해당 메시지를 띄우고 해당 URL 로 이동
function goto_caution($msg, $url)
{
    $str = "<script>";
    $str .= "alert('{$msg}');";
    $str .= "location.href = '{$url}';";
    $str .= "</script>";
    echo("$str");
    exit;
    
}
if(empty($designimages))
{
     $designimages = 1;
     $uploads_dir = "./design_image/$designimages";
}
else
{
    $designimages++;
    $uploads_dir = "./design_image/$designimages";
}

   echo $designimages."디자인프로세스";

$title = $designimages.".jpg";
$uploadfile = $_FILES['main_image']['name'];

if(!is_dir($uploads_dir))
{
    mkdir($uploads_dir);
    if(move_uploaded_file($_FILES['main_image']['tmp_name'],"$uploads_dir"."/main_image.jpg")  && move_uploaded_file($_FILES['sub_image1']['tmp_name'],"$uploads_dir"."/sub_image1.jpg") && move_uploaded_file($_FILES['sub_image2']['tmp_name'],"$uploads_dir"."/sub_image2.jpg") && move_uploaded_file($_FILES['sub_image3']['tmp_name'],"$uploads_dir"."/sub_image3.jpg") && move_uploaded_file($_FILES['sub_image4']['tmp_name'],"$uploads_dir"."/sub_image4.jpg"))
     {
        goto_caution("게시글 작성 완료", "/design_board");
     }
     else 
     {
        goto_caution("게시글 작성 완료", "/design_board");
    }
}
else
{
    if(move_uploaded_file($_FILES['main_image']['tmp_name'],"$uploads_dir"."/main_image.jpg")  && move_uploaded_file($_FILES['sub_image1']['tmp_name'],"$uploads_dir"."/sub_image1.jpg") && move_uploaded_file($_FILES['sub_image2']['tmp_name'],"$uploads_dir"."/sub_image2.jpg") && move_uploaded_file($_FILES['sub_image3']['tmp_name'],"$uploads_dir"."/sub_image3.jpg") && move_uploaded_file($_FILES['sub_image4']['tmp_name'],"$uploads_dir"."/sub_image4.jpg"))
     {
        goto_caution("게시글 작성 완료", "/design_board");
     }
     else 
     {
        goto_caution("게시글 작성 완료", "/design_board");
    }
}


?>

