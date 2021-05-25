<?php

$id=$_GET['id'];
$conn=mysqli_connect('localhost','bitnami','1234','Destination') or die('fail');
$des_sql = "SELECT * FROM desInfo WHERE id='$id';";
$des_query = mysqli_query($conn, $des_sql);

function select(){
  $conn=mysqli_connect('localhost','bitnami','1234','Destination') or die('fail');
  $NUM=$_GET['key_name'];
  $id=$_GET['id'];
  $query1 = "UPDATE desInfo SET orderDes='0' WHERE id='$id' AND orderDes='1';";
  $current_id1 = mysqli_query($conn, $query1) or die("<b>Error:</b> Problem on connection1<br/>" . mysqli_error($conn));
  $query2 = "UPDATE desInfo SET orderDes=1 WHERE id='$id' AND NUM=$NUM";
  $current_id2 = mysqli_query($conn, $query2) or die("<b>Error:</b> Problem on connection2<br/>" . mysqli_error($conn));
  }

if(array_key_exists('des_select', $_GET)){
select();
echo("<script>self.close()</script>");
}
?>

<html>
<head>
</head>
<body>
  <form method="get">
    <div style="border: 1px solid black; text-align: left;">
          <b>배송 주소</b><br>
              <?php 

                while($des_row=mysqli_fetch_array($des_query)){
              echo "<label><input type='radio' name='key_name' value='".$des_row['NUM']."'><table style='border:1px solid gray;width:97%;margin:3px;'><tr><td>";

        if($des_row['defaultDes'] == 1) echo "<p style='color: gray; font-size: 10pt;'>*현재 배송지</p>";

        echo "이름: ".$des_row['name']."<br>".
          "배송지 주소: ".$des_row['address']." ".$des_row['detailAddr']."<br>".
          "우편번호: ".$des_row['postcode']."<br>".
          "연락처: ".$des_row['phoneNum']."<br><br>".
          "
          <input type='hidden' name='NUM' value='".$des_row['NUM']."'>
          <input type='hidden' name='id' value='".$id."'>";
          
        echo "</tr></table></label>";
              }
              ?><input type='submit' name='des_select' value='선택'>
  </form>
</div>
<input type='button' value='배송지 등록' onclick='location.href="myPageDest.php"' >
<input type="button" value="뒤로가기" onclick="history.back()">
</body>
</html>
