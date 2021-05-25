<?php
$login=$_GET['login'];
$prevPage = $_SERVER['HTTP_REFERER'];
//로그인 확인

if (isset($_GET['basket'])) {
		if($login){
				$basketbook_amount=$_GET['basketbook_amount'];
		 		$image_num=$_GET['image_num'];
		 		$price=$_GET['price'];
		 		$author=$_GET['author'];
		 		$book_name=$_GET['book_name'];
		 		$id=$_GET['id'];
		 		$book_num=$_GET['book_num'];
		 		 //예지가 추가함
		 		$conn_basket = mysqli_connect("localhost","bitnami","1234","shoppingbasket") or die("connection fail");
		 		$sql ="SELECT basketbook_name FROM basket WHERE id='$id' and basketbook_num='$book_num'";
		 		$ret=mysqli_query($conn_basket,$sql);
		 		$exist=mysqli_num_rows($ret);
		 		if($exist>0){
		 			echo "<script>alert('이미 있는 상품!');
		 			history.back();
		 			</script>";
		 		}
		 		else{
  						$b_sql = "INSERT INTO basket(basketbook_index,basketbook_name,basketbook_author,basketbook_price,basketbook_amount,id,basketbook_num)
 						 VALUES (null,'$book_name','$author','$price','$basketbook_amount','$id','$book_num')"; //basketbook_image_num 컬럼 삭제 해서 지우고, id 컬럼 추가해서 넣음
 						 $current_id = mysqli_query($conn_basket, $b_sql) or die("<b>Error:</b>장바구니 에러!<br/>" . mysqli_error($conn_basket));
												}
  						
  						if (isset($current_id)) {
      							?><script>alert('장바구니 입력완료');
     				  			history.back();
       								</script>
       							
       							
       						
				
       <?php	


   			}
				}
			else{
				?><script type="text/javascript">
					alert('로그인이 필요합니다.');
					location.href='login.php';
				</script><?php
			}
  
}
elseif (isset($_GET['buy'])) {
	if($login){
    	?>
        		<script>
 				alert("현재 구매하기 비활성!");
				history.back();
 
				</script><?php
				}
	else{
		?>
        		<script type="text/javascript">
					alert('로그인이 필요합니다.');
					location.href='login.php';
				</script><?php
	}
}
?>	