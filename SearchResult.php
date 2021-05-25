<?php
	include_once "./layout.inc";
	$base = new layout;

	session_start();

	$conn = mysqli_connect('localhost', 'bitnami', '1234', 'book') or die('fail');

	$book_name = $_GET['book_name'];
	$category = $_GET['category'];
	$price1 = $_GET['price1'];
	$price2 = $_GET['price2'];

	if(empty($_REQUEST["book_name"])){ // 검색어가 empty 예외처리 
		$book_name ="";
	}
	else{
		$book_name =$_REQUEST["book_name"];
	}

	if($category == "all"){			//카테고리
		if($price1 < $price2){		//가격
			$max = $price2;
			$min = $price1;
			$sql = "SELECT * FROM bookdata WHERE is_delete = 0 AND (book_name LIKE '%$book_name%') AND (price >=".$min." AND price <= ".$max.")";
		}
		else if ($price1 > $price2){
			$max = $price1;
			$min = $price2;
			$sql = "SELECT * FROM bookdata WHERE is_delete = 0 AND (book_name LIKE '%$book_name%') AND (price >= ".$min." AND price <=".$max.")";
		}
		else if ($price1 == $price2 && ($price1 != 0 && $price2 != 0)){
			$sql = "SELECT * FROM bookdata WHERE is_delete = 0 AND (book_name LIKE '%$book_name%') AND price = ".$price2."";
		}
		else{
			$sql = "SELECT * FROM bookdata WHERE is_delete = 0 AND book_name LIKE '%$book_name%'";
		}

	}
	else{
		if($price1 < $price2){		//가격
			$max = $price2;
			$min = $price1;
			$sql = "SELECT * FROM bookdata WHERE is_delete = 0 AND category = '$category' AND (book_name LIKE '%$book_name%') AND (price >=".$min." AND price <= ".$max.")";
		}
		else if ($price1 > $price2) {
			$max = $price1;
			$min = $price2;
			$sql = "SELECT * FROM bookdata WHERE is_delete = 0 AND category = '$category' AND (book_name LIKE '%$book_name%') AND (price >= ".$min." AND price <=".$max.")";
		}
		else if ($price1 == $price2 && ($price1 != 0 && $price2 != 0)){
			$sql = "SELECT * FROM bookdata WHERE is_delete = 0 AND category = '$category' AND (book_name LIKE '%$book_name%') AND price = ".$price2."";
		}
		else{
			$sql = "SELECT * FROM bookdata WHERE is_delete = 0 AND category = '$category' AND book_name LIKE '%$book_name%'";
		}
			
	}

	$result = mysqli_query($conn, $sql);

	$base->style = "
		.infoBox{
			border: 1px solid #b0b0b0;
			width: 100%;
			height: 200px;
			padding: 5px;
		}
	";

?>
<!DOCTYPE html>
<html>
<head>
	<?php
		$base->LayoutStyle();
	?>
</head>
<body>
	<?php 
		$base->LayoutHeader();
		$base->LayoutMenu();
	?>
	<article>
		<p style="float: left;">
			<?php echo "'검색어: ".$book_name.', 카테고리: '.$category."' 검색결과"; ?>	

		</p>
		<?php
			while($des_row = mysqli_fetch_array($result)){
				echo "<table class='infoBox'><tr><td>";
				echo "<a href='detail_page.php?book_num=".$des_row['book_num']."'>".$des_row['book_name']."</a><br>".
					$des_row['category']."<br>".
					$des_row['author']."<br>".
					$des_row['price']."<br>";
				echo "</td></tr></table>";
			}
		?>
	</article>
	<?php
		$base->LayoutFooter();
	?>
</body>
</html>
