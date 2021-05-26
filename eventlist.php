<?php

	include_once "./layout.inc";
  	session_start();
 	 $base = new layout;

  	$base->link='./style.css';


  	//데베
	$connect =mysqli_connect('localhost','bitnami','1234','event') or die('connection fail');
	 $today = date("Y-m-d");
    $query = "SELECT * FROM eventdb WHERE finalDate >='$today' ORDER BY number DESC";
    $result = $connect->query($query);
	$total=mysqli_num_rows($result);
?>
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

<h2 align="center">진행중인 이벤트</h2>

<table>
	<thead>
		<tr>
			<td>번호</td>
			<td>제목</td>
			<td>날짜</td>
			<td>유효기간</td>
			<td>조회수</td>
		</tr>
	</thead>

	<tbody>
		<?php 
		while ($rows=mysqli_fetch_assoc($result)) {
			if($total%2==0){
?>
				<tr class="even">
			<?php }
			else{
			?>
				<tr>
			<?php } ?>
		<td><?php echo $total?></td>
		<td><a href="eventview.php?number=<?php echo $rows['number']?>"><?php echo $rows['title']?></td>
		<td><?php echo $rows['date']?></td>
		<td><?php echo $rows['finalDate']?></td>
		<td><?php echo $rows['hit']?></td>
		</tr>
	<?php
		$total--;
		}
	?>
	</tbody>
</table>
</center></article>
  <?php
    $base->LayoutFooter();
  ?>
</body>
</html>
