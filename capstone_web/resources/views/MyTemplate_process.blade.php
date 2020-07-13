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


 if(!empty($repre_img))
    {
        goto_caution("저장 성공.","/");  
    }
    else
    {
        goto_caution("저장 실패","/");
    }
?>