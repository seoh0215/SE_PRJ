<?php
	include_once "adminLayout.inc";
	$admin = new AdminLayout;
?>

<!DOCTYPE html>
<html>
	<head>
	<?php 
		$admin->AdminLayoutStyle();
	?>
	<style>
		th {border-top: 3px solid rgb(51, 175, 233); border-bottom:  1.5px solid rgb(160, 160, 160); padding: 3px;}
	</style>
</head>
	<body>
		<?php
			$admin->AdminLayoutHeader();
			$admin->AdminLayoutMenu();
		?>
		<article>
		<h1>책정보 추가</h1>
		<!--categoty/cate_dec/book_name/book_detail/author/price/book_image(이것만 다른 db임)-->
		<form name = "add_book" method="post" enctype="multipart/form-data" action = "book_list_upload.php">
		<table>
			<th>국내/국외/중고</th>
			<th>10진분류</th>
			<th>책이름</th>
			<th>책상세정보</th>
			<th>저자</th>
			<th>가격</th>
			<th>책이미지</th>
			<th>등록</th>
			<tr>
				<td>
					<select name ="category" size ='1' style = "width : 100px; height: 30px">
						<option value = "korea">국내</option>
						<option value = "foreign">국외</option>
						<option value = "used">중고</option>
					</select>
				</td>
				<td>
					<select name ="cate_dec" style = "height: 29px">
						<option value = 0> 000 총류</option>
						<option value = 1> 100 철학</option>
						<option value = 2> 200 종교</option>
						<option value = 3> 300 사회과학</option>
						<option value = 4> 400 자연과학</option>
						<option value = 5> 500 기술과학</option>
						<option value = 6> 600 예술</option>
						<option value = 7> 700 언어</option>
						<option value = 8> 800 문학</option>
						<option value = 9> 900 역사</option>
					</select>	
				</td>
				<td><input type="text" name="book_name"></td>
				<td><input type="text" name="book_detail"></td>
				<td><input type="text" name="author" style = " width : 80px;"></td>
				<td><input type="number" name="price" min ="0" max = "1000000" style = " width : 70px;"></td>
				<td><input type="file" name = "book_image"></td>
				<td><input type ="submit" value="등록"></td>
			</tr>
		</table>
		</form>

		<h1></h1>
		<!--상품이름, 가격, 상품가격으로 필터링-->
		<h2>책 필터링</h2>
		<form action="book_list_sort.php" method = "post">
			<table>
				<th>책이름 검색</th>
				<th>가격순으로 정렬</th>
				<th>상품 가격 필터(10만원단위)</th>
				<th>검색</th>
				<tr>
					<td><input type="text" name="book_name"></td>
					<td>
						<input type="radio" name = "sorting" value="0" checked = "checked"> <?php echo $row["sorting"]=="0" ? "checked" : "" ?>정렬x
						<input type="radio" name = "sorting" value="1" <?php echo $row["sorting"]=="1" ? "checked" : "" ?>>정렬o(오름차순)
					</td>
					<td>
						<div>
							<label> Value1: </label>
							<input type="range" name="range_price1" min="0" max="10" step="1" value="0" oninput="document.getElementById('value1').innerHTML=this.value;">
							<span id="value1"></span>
						</div>
						<div>
							<label> Value2: </label>
							<input type="range" name="range_price2" min="0" max="10" step="1" value="0" oninput="document.getElementById('value2').innerHTML=this.value;">
							<span id="value2"></span>
						</div>
					</td>
					<td><input type ="submit" value="검색"></td>

				</tr>

			</table>	
		</form>
		<h2>책 정보 출력</h2>
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
			error_reporting(E_ALL);
			ini_set( "display_errors", 1 );
			$conn =mysqli_connect('localhost','bitnami','1234','book') or die('connection fail');
   			$sql1 = "SELECT bookdata.*, upfile.* FROM bookdata INNER JOIN upfile ON bookdata.book_num = upfile.image_num WHERE is_delete=0;";
   			$result1 = mysqli_query($conn, $sql1);

   			while($bookdata_row = mysqli_fetch_array($result1)){
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
   		</table>
   		</form>
   	</article>
   		<?php
   			$admin->AdminLayoutFooter();
   		?>
	</body>
</html>