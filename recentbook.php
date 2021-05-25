<?php 

//책 이미지 가져오기 위함
$conn_image = mysqli_connect("localhost","bitnami","1234","book") or die ("connection fail");
$image_num = $_GET["image_num"];
$image_sql = "SELECT * FROM upfile";
$image_result = mysqli_query($conn_image, $image_sql);

//책 정보 가져오기 위함
$conn_book =mysqli_connect("localhost","bitnami","1234","shoppingbasket") or die("connection fail"); 
$basket_sql = "SELECT * FROM basket ORDER BY basketbook_index DESC";
$basket_result = mysqli_query($conn_book, $basket_sql);

$total_price = 0;

?>
<HTML>
<HEAD>
	<meta charset = 'utf-8'/>
	<link rel="stylesheet" type="text/css" href="basketstyle.css"/>
</HEAD>
<BODY>

<div id="main_in">
			<div id = "content">
				<center><h1>장바구니</h1></center>
				<?php
				if(!$basket_result){
					echo"장바구니가 비었습니다.";
				} else{
				?>
				<table class = "list-table">
				<thead>
					<tr>
						<!----상품정보에는 이미지, 책이름, 저자가 들어감-->
						<th width = "300">상품 정보</th>
						<th width = "150">상품 가격</th>
						<!----수량 부분에 조절 아이콘 추가해야 함-->
						<th width = "150">수량</th>
						<!----총 금액에 계산 식 넣어야 함-->
						<th width = "150">총 금액</th>
						<!--삭제 부분에 삭제 아이콘 추가해야 함-->
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
	echo "<br>";
	$final="총 주문금액: ";
	echo "<font size=5>".$final;
	echo $total_price;
	$final_won=" 원";
	echo "<font size=3>".$final_won;
	?>
	<a href="#"><button type="submit" style="background-color:rgb(51, 175, 233); border-color: rgb(51, 175, 233); height:70px; width:130px; "><h2>결제하기</h2></button></a>


</div>
</div>
<footer></footer>
<?php
}
?>
</BODY>
</HTML>


