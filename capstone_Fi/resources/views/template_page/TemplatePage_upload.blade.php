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

    if(!empty($Template_table))
    {
        goto_caution("템플릿 생성 완료.","/");
    }
    else
    {
        goto_caution("템플릿 업데이트 완료.","/");
    }
?>