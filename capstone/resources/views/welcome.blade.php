
<?php
    
    if(empty($template_table))
       {
          $user = DB::table('template_tables')->where('user_id', 'root')->first();
        echo $user->user_id;
       }
       else
       {
           echo "값 없음";
       }
    ?>