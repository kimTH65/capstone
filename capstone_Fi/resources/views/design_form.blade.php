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

     goto_caution("디자인 제작을 요청 했습니다.","/design_board");

?>