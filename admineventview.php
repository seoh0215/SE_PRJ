<?php
    //레이아웃
include_once "adminLayout.inc";
    $admin = new AdminLayout;

    session_start();

    //db
	$connect =mysqli_connect('localhost','bitnami','1234','event') or die('connection fail');
    $number=$_GET['number'];
    $sql = "SELECT title,content,date,finalDate,hit FROM eventdb WHERE number=$number";

    $result = $connect->query($sql);
    $rows=mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>
<head>
    <?php $admin->AdminLayoutStyle();?>
</head>
<body>
     <?php 
    $admin->AdminLayoutHeader();
    $admin->AdminLayoutMenu();

    $content=$rows['content'];
    $str_content = str_replace("\r\n", "<br>", $content);
  ?>
<article><center>
 <div  id="wrap">
    <table  align = center  border=0 cellpadding=2 >
        <tr>
            <td align= center bgcolor=#ccc><font color=white>이벤트</font></td>
        </tr>
<table>
    <tr>
        <td colspan="4"><?php echo $rows['title']?></td>
    </tr>
        <tr>
            <img src="admineventview_img.php?number=<?php echo $number ?>" / style="max-width: 80%;height: auto;">
        </tr>

        <tr>
                <td>소비자조회수</td>
                <td><?php echo  $rows['hit']?></td>
        </tr>
        <tr>
            <td colspan="4"><?php echo $str_content?></td>
        </tr>
</table>
<div>
                <button class="btn" onclick="location.href='adminevent_list.php'" >목록으로</button>
                <button onclick="location.href='./adminevent_modify.php?number=<?=$number?>'">수정</button>
 
                <button onclick="location.href='./adminevent_delete.php?number=<?=$number?>'">삭제</button>
        </div>
        </table>
</div>
  </center></article>
  <?php
    $admin->AdminLayoutFooter();
  ?>
</body>
</html>
