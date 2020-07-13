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
if($boardimages == 1)
{
     $uploads_dir = "./board_image/$boardimages";
}
else
{
    $boardimages++;
    $uploads_dir = "./board_image/$boardimages";
}
 $title = $boardimages.".jpg";
$uploadfile = $_FILES['b_file']['name'];

if(!is_dir($uploads_dir))
{
    mkdir($uploads_dir);
    if(move_uploaded_file($_FILES['b_file']['tmp_name'],"$uploads_dir"."/1.jpg"))
     {
        goto_caution("게시글 작성 완료", "/board");
     }
     else 
     {
        goto_caution("게시글 작성 완료", "/board");
    }
}
else
{
    if(move_uploaded_file($_FILES['b_file']['tmp_name'],"$uploads_dir"."/1.jpg"))
     {
        goto_caution("게시글 작성 완료", "/board");
     }
     else 
     {
        goto_caution("게시글 작성 완료", "/board");
    }
}



?>



        goto_caution("게시글 작성 완료","/board");
?>
