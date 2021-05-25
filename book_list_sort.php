<?php

	error_reporting(E_ALL);
	ini_set( "display_errors", 1 );
	$conn = mysqli_connect('localhost','bitnami','1234','book') or die('fail');

	$book_name = $_POST['book_name'];
	$sorting = $_POST['sorting'];
	$range_price1 = $_POST['range_price1'];
	$range_price2 = $_POST['range_price2'];

	if($range_price1 < $range_price2){
		$max = $range_price2*100000;
		$min = $range_price1*100000;
	}
	elseif ($range_price1 > $range_price2) {
		$max = $range_price1*100000;
		$min = $range_price2*100000;
	}
	else{
		$max = 1000000;
		$min = 0;
	}
		
	if(empty($_REQUEST["book_name"])){ // 검색어가 empty일 때 예외처리를 해준다. 
		$book_name ="";
	}
	else{
		$book_name =$_REQUEST["book_name"];
	}
	
	?>

	<!DOCTYPE html>
	<head>
		<style> 
			th {border-top: 3px solid rgb(51, 175, 233); border-bottom:  1.5px solid rgb(160, 160, 160); padding: 3px;}
		</style>
	</head>
	<h1><?php echo "'".$book_name."' 검색결과"; ?> </h1>

	<table>
		<tr>
			<th>삭제</th>
			<th>수정</th>
			<th>상품번호</th>
			<th>국내/국외/중고</th>
			<th>10진분류</th>
			<th>책이름</th>
			<th>책상세정보</th>
			<th>저자</th>
			<th>가격</th>
			<th>이미지</th>
		</tr>

	<?php

	if($sorting == 0){
		$sql1 = "SELECT bookdata.*, upfile.* FROM bookdata INNER JOIN upfile ON bookdata.book_num = upfile.image_num WHERE (price>='$min' AND price<='$max') AND book_name LIKE '%$book_name%'";
		$result = mysqli_query($conn, $sql1);
	}
	else{
		$sql2 = "SELECT bookdata.*, upfile.* FROM bookdata INNER JOIN upfile ON bookdata.book_num = upfile.image_num WHERE (price>='$min' AND price<='$max') AND book_name LIKE '%$book_name%' ORDER BY price ASC";
		$result =  mysqli_query($conn, $sql2);
	}

		while($bookdata_row = mysqli_fetch_array($result)){
   				echo '<tr>';
   				echo "<td><form method = 'POST' action = 'book_list_delete.php'>
   					<input type='hidden' name='is_delete' value='".$bookdata_row['book_num']."'>
   					<input type='submit' value='삭제'></form></td>";
   				echo "<td><form method='POST' action='book_list_rewrite_from.php'>
					<input type='hidden' name='edit_book' value='".$bookdata_row['book_num']."'>
					<input type='submit' value='수정'></form></td>";
   				echo '<td>'.$bookdata_row['book_num'].'</td>';
   				echo '<td>'.$bookdata_row['category'].'</td>';
   				echo '<td>'.$bookdata_row['cate_dec'].'</td>';
   				echo '<td>'.$bookdata_row['book_name'].'</td>';
   				echo '<td>'.$bookdata_row['book_detail'].'</td>';
   				echo '<td>'.$bookdata_row['author'].'</td>';
   				echo '<td>'.$bookdata_row['price'].'</td>';
   				echo '<td><img src="book_image_view.php?image_num='.$bookdata_row['book_num'].'" width="100" height="130"/></td>';
   				echo '</tr><br>';
   			}
	
?>

<?php
		/*if(empty($_REQUEST["book_name"])){ // 검색어가 empty일 때 예외처리를 해준다. 
			$book_name ="";
		}
		else{
			$book_name =$_REQUEST["book_name"];
		}

		$sql1 = "SELECT bookdata.*, upfile.* FROM bookdata INNER JOIN upfile ON bookdata.book_num = upfile.image_num WHERE book_name LIKE '%$book_name%'";
		$result1 = mysqli_query($conn, $sql1);

		while($bookdata_row = mysqli_fetch_array($result1)){
   				echo '<tr>';
   				echo '<td><button type = "submit">삭제</button></td>';
   				echo "<td><form method='POST' action='book_list_rewrite_from.php'>
					<input type='hidden' name='edit_book' value='".$bookdata_row['book_num']."'>
					<input type='submit' value='수정'></form></td>";
   				echo '<td>'.$bookdata_row['book_num'].'</td>';
   				echo '<td>'.$bookdata_row['category'].'</td>';
   				echo '<td>'.$bookdata_row['cate_dec'].'</td>';
   				echo '<td>'.$bookdata_row['book_name'].'</td>';
   				echo '<td>'.$bookdata_row['book_detail'].'</td>';
   				echo '<td>'.$bookdata_row['author'].'</td>';
   				echo '<td>'.$bookdata_row['price'].'</td>';
   				echo '<td><img src="book_image_view.php?image_num='.$bookdata_row['book_num'].'" width="100" height="130"/></td>';
   				echo '</tr><br>';
   			}*/ // 검색창 했당 fxxxing


   		/*

   			if($range_price1 < $range_price2){
		$max = $range_price2*100000;
		$min = $range_price1*100000;
	}
	elseif ($range_price1 > $range_price2) {
		$max = $range_price1*100000;
		$min = $range_price2*100000;
	}
	else{
		$max = 1000000;
		$min = 0;

	}
	$sql1 = "SELECT bookdata.*, upfile.* FROM bookdata INNER JOIN upfile ON bookdata.book_num = upfile.image_num WHERE price>=$min AND price<=$max";
		$result1 = mysqli_query($conn, $sql1);

		while($bookdata_row = mysqli_fetch_array($result1)){
   				echo '<tr>';
   				echo '<td><button type = "submit">삭제</button></td>';
   				echo "<td><form method='POST' action='book_list_rewrite_from.php'>
					<input type='hidden' name='edit_book' value='".$bookdata_row['book_num']."'>
					<input type='submit' value='수정'></form></td>";
   				echo '<td>'.$bookdata_row['book_num'].'</td>';
   				echo '<td>'.$bookdata_row['category'].'</td>';
   				echo '<td>'.$bookdata_row['cate_dec'].'</td>';
   				echo '<td>'.$bookdata_row['book_name'].'</td>';
   				echo '<td>'.$bookdata_row['book_detail'].'</td>';
   				echo '<td>'.$bookdata_row['author'].'</td>';
   				echo '<td>'.$bookdata_row['price'].'</td>';
   				echo '<td><img src="book_image_view.php?image_num='.$bookdata_row['book_num'].'" width="100" height="130"/></td>';
   				echo '</tr><br>';
   			}*/	 // 가격 필터링했당 

   			//ASC = 오름차순, DESC = 내림차순

?>