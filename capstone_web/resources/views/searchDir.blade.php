<?php
$userimages++;

 $uploads_dir = "./UserUploads/$user_id";
 $title = $userimages.".jpg";
 $uploadfile = $_FILES['upload']['name'];

if(!is_dir($uploads_dir))
    {
        mkdir($uploads_dir);
    
        if(move_uploaded_file($_FILES['upload']['tmp_name'],"$uploads_dir/$title"))
        {
 ?>
            <script>
                //alert("서버에 이미지가 저장 되었습니다.");
                //document.location.href="/toolPage";
            </script>
        <?php
         } 
         else 
         {?>
            <script>
                //alert("이미지 업로드 실패");
                //document.location.href="/toolPage";
            </script>
        <?php
        }
    }
else
    {
        if(move_uploaded_file($_FILES['upload']['tmp_name'],"$uploads_dir/$title"))
        {
            ?>
            <script>
                //alert("서버에 이미지가 저장 되었습니다.");
                //document.location.href="/toolPage";
            </script>
        <?php
         } 
         else 
         {?>
            <script>
                //alert("이미지 업로드 실패");
                //document.location.href="/toolPage";
            </script>
        <?php
        }
    }
?>
    
<!DOCTYPE html>
<html>
    <head>
<script src="https://code.jquery.com/jquery-latest.js"></script> 
     </head>
    <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
    
        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 30%; /* Could be more or less, depending on screen size */                          
        }
 
</style>
 
 <body>
 
    <!-- The Modal -->
    <div id="myModal" class="modal">
 
      <!-- Modal content -->
    <form action="action_upload" method = "POST">
   @csrf 
      <div class="modal-content">
    
                <p style="text-align: center;"><span style="font-size: 14pt;"><b><span style="font-size: 24pt;">업로드</span></b></span></p>
                <div class="form-group">
                <label for="exampleInputEmail1">아이디</label><br>
                    <input type="text" class="form-control"value = "<?php echo $user_id;?>" id="exampleInputEmail1"style="text-align: center; line-height: 1.5; width:420px;height:30px;" name = "user_id" aria-describedby="emailHelp" placeholder="Enter ID"><br>
                    <small id="IdHelp" class="form-text text-muted">아이디를 입력 해주세요</small>
                 </div><br>
                    
                    
                    <div class="form-group">
                    <label for="exampleInputPassword1">템플릿 이름</label><br>
                    <input type="text" class="form-control" id="exampleInputPassword1" style="text-align: center; line-height: 1.5; width:420px;height:30px;"  name = "title" placeholder="template name" value = "<?php echo  $title;?>"<br>
                    <br><small id="IdHelp" class="form-text text-muted">템플릿 이름을 입력 해주세요</small>
                </div>
         
                <p style="text-align: center; line-height: 1.5;"><span style="font-size: 14pt;">이름과 템플릿 </span></p>
                <p style="text-align: center; line-height: 1.5;"><b><span style="color: rgb(255, 0, 0); font-size: 14pt;">반드시 입력 해주세요!</span></b></p>
                <p style="text-align: center; line-height: 1.5;"><span style="font-size: 14pt;">업로드된 템플릿은</span></p>
                <p style="text-align: center; line-height: 1.5;"><span style="font-size: 14pt;"><br /></span></p>
                <p style="text-align: center; line-height: 1.5;"><span style="font-size: 14pt;">내 템플릿에서 </span></p>
                <p style="text-align: center; line-height: 1.5;"><span style="font-size: 14pt;">확인 할 수 있습니다.</span></p>
                <p style="text-align: center; line-height: 1.5;"><br /></p>
                <p><br /></p>
            <div style="cursor:pointer;background-color:#DDDDDD;text-align: center;padding-bottom: 1px;padding-top: 1px;">
                     <input type = "submit" style = "background-color:#DDDDDD; width:450px; height:50px;border:none;">
            </div>
      
      </div>
 </form>
    </div>
        <!--End Modal-->
 
 
    <script type="text/javascript">
      
        jQuery(document).ready(function() {
                $('#myModal').show();
        });
        //팝업 Close 기능
        function close_pop(flag) {
             $('#myModal').hide();
        };
        
      </script>
          </body>
          </html>