
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
            if($i!=$no->id-1)
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
                            $recomend[$i] = $i;
                        }
                    } 
                }
                $recomend[$i] = $score_count++;
            }else{
                $recomend[$i]=$rank_max+1;
            }
        }

        for($e=0;$e<=$rank_max;$e++){

            for($k=0;$k<count($recomend);$k++)
            {
                if($recomend[$k]==$e){
                    $rank[$rank_count]=$k;
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

        return print($result);
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
