<?php

  include_once "./layout.inc";
  session_start();
  $base = new layout;

  $base->link='./style.css';

//예지
    $conn =mysqli_connect("localhost","bitnami","1234","book") or die("connection fail");
    $image_num = $_GET["image_num"];

    $sql = "SELECT image_num FROM upfile ORDER BY image_num DESC LIMIT 7"; 
    $result = mysqli_query($conn, $sql);
//첫번째 부분 추가 끝
//슬라이더용
    $connect =mysqli_connect("localhost","bitnami","1234","event") or die("connection fail");
   	$number = $_GET["number"];
    /////여기 수정
  $today = date("Y-m-d");
    $query = "SELECT number, title,finalDate FROM eventdb WHERE finalDate >='$today' ORDER BY number DESC"; 
    /////여기까지
    $s_result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <?php $base->LayoutStyle();?>
   <link rel="stylesheet" href="./jquery.bxslider.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="./jquery.bxslider.min.js"></script>
  <script>
    $(document).ready(function(){
      $(".slider").bxSlider({
        auto:true, 
        captions:true,
        adaptiveHeight:true, 
        touchEnabled:false
      });
    });
  </script>
</head>
<body>
  <?php 
    $base->LayoutHeader();
    $base->LayoutMenu();
  ?>
  <article><center>
     <link rel="stylesheet" href="./jquery.bxslider.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="./jquery.bxslider.min.js"></script>
  <script>
    $(document).ready(function(){
      $(".slider").bxSlider({
        auto:true, 
        captions:true,
        adaptiveHeight:true, 
        touchEnabled:false
      });
    });
  </script>
  <div class="slider">
        <?php
  while($s_row = mysqli_fetch_array($s_result)) {
  ?>
    <div><a href="eventview.php?number=<?php echo $s_row["number"]; ?>"><img src="admineventview_img.php?number=<?php echo $s_row["number"]; ?>" /style="height: 400px;"  title="<?php echo $s_row['title'];?>" ></a></div>
<?php 
}
  mysqli_close($connect);?>
  </div>

  <div class="recentbook">
<div style="background-color:rgb(51, 175, 233); border:1px solid; padding:10px;">
  <small>최신등록도서</small>
  </div>
  <div style="background-color:#fff; border:1px solid; padding:10px;">
    <?php
  while($row = mysqli_fetch_array($result)) {
  ?>
    <a href="#"><img style="display: inline-block; text-align: center;" src="book_image_view.php?image_num=<?php echo $row["image_num"]; ?>" width="100" height="130"/></a>

    <?php   
  }
    mysqli_close($conn);
?>
  
</div>
</div>
</center></article>
  <?php
    $base->LayoutFooter();
  ?>
</body>
</html>

