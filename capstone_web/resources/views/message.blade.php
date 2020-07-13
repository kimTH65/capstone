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

        goto_caution("쪽지를 보냈습니다.","/");  
?>