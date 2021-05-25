<?php
	include_once "./layout.inc";
	$base = new layout;

	$connect = mysqli_connect('localhost','bitnami','1234','event') or die('connection fail');

	$page_list_size = 1;

	$page = $_GET['page'] ? $_GET['page'] : 0;
	$offset = ($page) * $page_list_size;

	$sql_count = "SELECT * FROM eventdb WHERE finalDate >='$today'";
	$result_cnt = mysqli_query($connect, $sql_count);
	$total_row = mysqli_num_rows($result_cnt);

    $query = "SELECT * FROM eventdb WHERE finalDate >='$today' ORDER BY number DESC LIMIT $offset, $page_list_size";
    $result = $connect->query($query);
?>

<!DOCTYPE html>
<html>
<head>
	<?php
		$base->style = "
			#boardTable th{
			border-top: 3px solid rgb(51, 175, 233);
			border-bottom: 1.5px solid rgb(160, 160, 160);
			padding: 10px;
		}";
		$base->LayoutStyle();
	?>
</head>
<body>
	<?php 
		$base->LayoutHeader();
		$base->LayoutMenu();
	?>
	<article>
		<div id = 'boardArea'>
			<center>
			<h1>공지/이벤트 게시판</h1>
			<table id = 'boardTable'>
				<tr>
					<th>제목</th>
					<th>날짜</th>
				</tr>
				<?php 
					while ($rows=mysqli_fetch_array($result)) {
						echo "<tr>".
						"<td><a href='eventview.php?number=".$rows['number']."'>".$rows['title']."</a></td>".
						"<td>".$rows['date']."</td>".
						"</tr>";
					}
				?>
			</table>
			<?php
				$pages = ceil($total_row/$page_list_size);
				for($p = 0; $p < $pages; $p++){
					echo "<a href='$PHP_SELF?page=$p'>[$p]</a>";
				}
			?>
		</center>
		</div>
	</article>
	<?php
		$base->LayoutFooter();
	?>
</body>
</html>