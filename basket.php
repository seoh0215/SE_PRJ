<?php 

  include_once "./layout.inc";
  session_start();
  $base = new layout;

  $base->link='./style.css';
  $id = $_SESSION['id'];

//책 정보 가져오기 위함
$conn_book =mysqli_connect("localhost","bitnami","1234","shoppingbasket") or die("connection fail"); 
$basket_sql = "SELECT * FROM basket WHERE id = '$id' ORDER BY basketbook_index DESC ";
$basket_result = mysqli_query($conn_book, $basket_sql);

$total_price = 0;

?>
<HTML>
<HEAD>
	<meta charset = 'utf-8'/>
	<link rel='stylesheet' type='text/css' href='style.css'>
	<link rel="stylesheet" type="text/css" href="basketstyle.css"/>
</HEAD>
<BODY>
	<?php 
    $base->LayoutHeader();
    $base->LayoutMenu();
 	?>
 <article><center>

<!----<div id="main_in">----->
			<div id = "content">
				<center><h1>장바구니</h1></center>

				<?php  ?>

				<table class = "list-table">
				<thead>
					<tr>
						<!----상품정보에는 이미지, 책이름, 저자가 들어감-->
						<th width = "300">상품 정보</th>
						<th width = "150">상품 가격</th>
						<th width = "150">수량</th>
						<th width = "150">총 금액</th>
						<th width = "100">삭제</th>
					</tr>
				</thead>

				<?php
				while($bask = mysqli_fetch_array($basket_result)) {

					echo '<tbody><tr>
				  		<td width="200">
			        	<div class="bak_item">';
				    echo "<br>";
				    echo '<div class="pro_name"><h3>'.$bask['basketbook_name'].'</h3></div>';
				    echo "<br>";
				    echo '<div class="pro_author">'.$bask['basketbook_author'].'</div>';
				    echo '</div></td>';
				
				  	echo '<td width="150">'.$bask['basketbook_price']. '원</td>';


				  	echo '<td width="150">
				  	<form method = "POST" action="re_amount.php">
				  	<input type= "hidden" name="index" value="'.$bask['basketbook_index'].'">
				  	<input id='.$bask['basketbook_index'].' type="text" name="result" value = "'.$bask['basketbook_amount'].'" size="3">';


				  	echo '<input type="button" value=" + " onclick="count'.$bask['basketbook_index'].'(\'plus\');">
				  		<input type="button" value=" - " onclick="count'.$bask['basketbook_index'].'(\'minus\');">
				  		<br><br><input type="submit" value="수량 등록"></form></td>';

				  	
					echo '<script language="JavaScript">
				  		function count'.$bask['basketbook_index'].'(type){';
					echo "resultElement = document.getElementById(".$bask['basketbook_index'].");";
					echo "	number = resultElement.value;

				  			if(type == 'plus'){
				  				number = parseInt(number)+1;
				  			} else if(type == 'minus'){
				  				if(number > 1) number = parseInt(number)-1;
				  			}
				  			resultElement.value = number;
				  		}

						</script>";
						

					echo '<td width="150">'.$bask['basketbook_amount']*$bask['basketbook_price'].'원</td>'; 

				  	echo'<td width="100"><form name = "form" method = "post" action="deleteBasket.php"><input type= "hidden" name="index" value="'.$bask['basketbook_index'].'"><input type="submit" name="delete" value="삭제";></a></form></td>




				  		</tr>
						</tbody>';

					$total_price += $bask['basketbook_amount']*$bask['basketbook_price'];
					mysqli_close($connect);
					
		   			
					}
					

				?>
	</table>
	<?php

	if($total_price == 0){

		echo "<br>";
		echo "<br>";
	    echo "<br>";
	    echo "<br>";

		echo "장바구니에 등록된 상품이 없습니다";
		echo "<br>";
	    echo "<br>";
	    echo "<br>";
	    echo "<br>";
	    echo "<br>";
	    echo "<br>";
	    echo "<br>";
	    echo "<br>";
	    echo "<br>";
	} else {

	$final="총 주문금액: ";
	echo "<font size=5>".$final;
	echo $total_price;
	$final_won=" 원";
	echo "<font size=3>".$final_won;



	?>

	<a href="#"><button type="submit" style="background-color:rgb(51, 175, 233); border-color: rgb(51, 175, 233); height:70px; width:130px; "><h2>결제하기</h2></button></a>

<?php }?>

</div>
<!----</div>---->

</center></article>


<?php
$base->LayoutFooter();
?>

</BODY>
</HTML>