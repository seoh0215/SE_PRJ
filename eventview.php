<?php
  include_once "./layout.inc";
  session_start();
  $base = new layout;

  $base->link='./style.css';
	$connect =mysqli_connect('localhost','bitnami','1234','event') or die('connection fail');
    $number=$_GET['number'];
    $sql = "SELECT title,content,date,finalDate,hit FROM eventdb WHERE number=$number";

    $result = $connect->query($sql);
    $rows=mysqli_fetch_assoc($result);

    $hit = "UPDATE eventdb SET hit=hit+1 WHERE number=$number";

                $connect->query($hit);
?>


<!DOCTYPE html>
<html>
<head>
    <?php $base->LayoutStyle();?>
</head>
<body>
<?php 
    $base->LayoutHeader();
    $base->LayoutMenu();

    
    $content=$rows['content'];
    $str_content = str_replace("\r\n", "<br>", $content);
  ?>
 <article><center>

<div  id="wrap">
    <table  align = center  border=0 cellpadding=2 >
        <tr>
            <td height=20 align= center bgcolor=#ccc><font color=white>이벤트</font></td>
        </tr>
<table>
    <tr>
        <td colspan="4"><?php echo $rows['title']?></td>
    </tr>
        <tr>
            <td><img src="admineventview_img.php?number=<?php echo $number ?>" / style="max-width: 100%;height: auto;"></td>
        </tr>

        <tr>
            <td colspan="4"><?php echo $str_content?></td>
        </tr>
</table>
<div>
                <button class="btn" onclick="location.href='eventlist.php'" >이벤트 목록으로</button>
        </div>
        </table>
</div>
</center></article>
  <?php
    $base->LayoutFooter();
  ?>
</body>
</html>