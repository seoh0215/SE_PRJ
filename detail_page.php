<?php
//레이아웃

  include_once "./layout.inc";

  session_start(); //예지가 추가함
  $base = new layout;
  $base->link='./style.css';
  if(isset($_SESSION['id'])){
  $login=TRUE;
}

  $id = $_SESSION['id']; //예지가 추가함
  //
 $connect = mysqli_connect(
  'localhost',      //주소
  'bitnami',        //username
  '1234',           //pw
  'book'            //database_name
) or die('connection fail');

 $book_num=$_GET['book_num'];

 $query="SELECT category, cate_dec, book_name, author, price,book_detail FROM bookdata WHERE book_num=$book_num";
$result = $connect->query($query);
$rows=mysqli_fetch_assoc($result);

  $content=$rows['book_detail'];
   $str_content = str_replace("\r\n", "<br>", $content);
  
//이미지데이터
    $image_num = $book_num;

    $sql = "SELECT image_num FROM upfile where image_num=$image_num";
    $iresult = mysqli_query($connect, $sql);
    $irows=mysqli_fetch_assoc($iresult);

    //배송 주소 확인!
$conn=mysqli_connect('localhost','bitnami','1234','Destination') or die('fail');
$des_sql = "SELECT * FROM desInfo WHERE id='$id' and orderDes=1;";
$des_query = mysqli_query($conn, $des_sql);

//장바구니 데이터
$book_name=$rows['book_name'];
$conn_book =mysqli_connect("localhost","bitnami","1234","shoppingbasket") or die("connection fail"); 
$bsk_sql = "SELECT * FROM basket WHERE id='$id' and basketbook_num='$book_num'";
$basket_result = mysqli_query($conn_book,$bsk_sql);
$bask = mysqli_fetch_array($basket_result);

//
if (!$bask['basketbook_amount']) {
  $basketbook_amount=0;
}
else{
  $basketbook_amount=$bask['basketbook_amount'];
}
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
  ?>
   <article><center>
  <form method="get" action="detail_page_action.php">
    <div class=mainbox>

        <div class="img_sec"  style="display: inline-block;">
        <img src="book_image_view.php?image_num=<?php echo $irows["image_num"]; ?>" /  height = "300px">
        </div>
        <div class="subbox" style="display: inline-block; height: 300px; ">
        <h2><?php echo $rows['book_name']?></h2>
        <hr size = "3" color = "burlywood">
        <table>
            <tr>
                <th>카테고리</th>
                <td><?php echo $rows['category']?></td>
            </tr>

            <tr>
                <th>10진분류</th>
                <td><?php echo $rows['cate_dec']?>
            </tr>
            <tr>
                <th>저자</th>
                <td><?php echo $rows['author']?></td>
            </tr>

            <tr> 
                <th class = "sub">배송비</th>
                <td class = "sub">무료배송</td>
            </tr>

            <tr>
                <th>판매가</th>
                <td><?php echo $rows['price']?></td>
            </tr>
            <tr>
              <th>구매수량</th>
              <td>
                <input type="number" name="basketbook_amount" value="1" min="1">
              </td>
            </tr>
            
            <tr>
              <th>장바구니 현황</th>
              <td><?php echo $basketbook_amount,"개의 상품이 들어있습니다";?></td>
            </tr>
           
        </table>
        <br>

<input type="hidden" name="id" value="<?php echo $id;?>">
<input type="hidden" name="login" value="<?php echo $login;?>">
<input type="hidden" name="image_num" value="<?php echo $irows["image_num"];?>">
<input type="hidden" name="price" value="<?php echo $rows["price"];?>">
<input type="hidden" name="author" value="<?php echo $rows['author'];?>">
<input type="hidden" name="book_name" value="<?php echo $rows['book_name'];?>">
<input type="hidden" name="book_num" value="<?php echo $book_num;?>">
<script type="text/javascript">
  function move(){
    location.href="destination_selection.php?id=<?php echo $id?>"
  }
  function register(){
    alert("배송지 추가화면으로 이동합니다.");
    location.href="myPageDest.php"
  }
</script>
<div style="border: 1px solid black; text-align: left;">
          <b>기본 배송 주소</b><br>
              <?php 
              $des_row=mysqli_fetch_array($des_query);

              echo "<table margin:3px;'><tr><td>";
              echo "이름: ".$des_row['name']."<br>".
          "배송지 주소: ".$des_row['address']." ".$des_row['detailAddr']."<br>".
          "우편번호: ".$des_row['postcode']."<br>".
          "연락처: ".$des_row['phoneNum']."<br><br>";
          if(!$des_row){
              echo "<input type='button' name='des_select' value='배송지 등록' onclick='register()' >";
              echo "<input type='button' name='des_select' value='기본 배송 주소 설정' onclick='move()' >";
          }
          else{
            echo "<input type='button' name='des_select' value='기본 배송 주소 설정' onclick='move()' >";
          }
              echo "</tr></table>";
              ?>

</div>
        <input type ="submit" name="buy" value = "구매하기(비활성)"/> 
        <input type ="submit" name="basket" value = "장바구니"/>
        </div>
        
        </div>

</form>
<div></div>


       
        <div>
          <h3>상세 설명 </h3>
          <?php echo $str_content?></div>
          </center></article>
  <?php
    $base->LayoutFooter();
  ?>
    </body>
</html>