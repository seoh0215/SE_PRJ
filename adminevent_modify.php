<?php           
    include_once "adminLayout.inc";
    $admin = new AdminLayout;

    session_start();
//데베
        $connect =mysqli_connect('localhost','bitnami','1234','event') or die('connection fail');

        $number = $_GET['number'];
        $sql = "SELECT title,content,date,finalDate,hit FROM eventdb WHERE number=$number";
        $result = $connect->query($sql);
        $rows = mysqli_fetch_assoc($result);
 
        $title = $rows['title'];
        $content = $rows['content'];
        $finalDate=$rows['finalDate'];

        session_start();
 
?>

<html>
<head>
       <?php $admin->AdminLayoutStyle();?>
</head>
<body>
 <?php 
    $admin->AdminLayoutHeader();
    $admin->AdminLayoutMenu();
  ?>
  <article><center>
<form method = "post" action = "adminevent_modify_action.php" enctype="multipart/form-data">
        <table  align = center  border=0 cellpadding=2 >
                <tr>
                        <td height=20 align= center bgcolor=#ccc><font color=white> 글수정</font></td>
                </tr>
                <tr>
                        <td bgcolor=white>
                <table class = "table2">

                        <tr>
                                <td>제목</td>
                                <td><input type = text name = title size=60 value="<?=$title?>"></td>
                        </tr>
                        <tr>
                                <td>유효기간</td>
                                <td><input type="date" name="finalDate" value="<?=$content?>"></textarea></td>
                        </tr>
 
                        <tr>
                                <td>내용</td>
                                <td><textarea name = content cols=85 rows=15><?=$content?></textarea></td>
                        </tr>
                        <tr>
                                <td>이미지</td>
                                <td><input type="file" name="userImage" value="필수 업로드" /></td>
                        </tr>
                        </table>
 
                        <center>
                                <input type="hidden" name="number" value="<?=$number?>">
                                <input type = "submit" value="작성">
                        </center>
                </td>
                </tr>
        </table>
</center></article>
   <?php
    $admin->AdminLayoutFooter();
  ?>
</body>
</html>
        
        