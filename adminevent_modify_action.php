<?php
    error_reporting(E_ALL);
    ini_set( "display_errors", 1 );

    
    extract($_REQUEST);

    if (is_uploaded_file($_FILES['userImage']['tmp_name'])){
        $connect = mysqli_connect('localhost','bitnami','1234','event') or die('connection fail');
        $number=addslashes($number);
        $title=addslashes($title);
        $finalDate=addslashes($finalDate);
        $content=addslashes($content);
        $date = date('Y-m-d H:i:s');
        
        $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
        $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);

        $imageType=$imageProperties['mime'];

        $query = "UPDATE eventdb SET title='$title', content='$content',finalDate='$finalDate', date='$date',imageType='$imageType',imageData='{$imgData}' WHERE number=$number";
        
        $current_id = mysqli_query($connect, $query) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($connect));
        if(isset($current_id)) {
            ?><script type="text/javascript">
            alert("<?php echo"수정 완료."?>");
            window.parent.location.href="adminevent_list.php";
            </script>
            <?php
             }
        }
    else
    {
       ?>
       <script>
            alert("<?php echo"사진이 등록되지 않았습니다."?>");
            history.back();
                </script><?php
    }
    ?>


