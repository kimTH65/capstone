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

    if(!empty($home))
    {
        goto_caution("아이디 혹은 닉네임이 존재 합니다.","/");  
    }
    else
    {
        goto_caution("회원가입에 성공 하셨습니다.","/");
    }
?>