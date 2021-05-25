<?php


	include_once "adminLayout.inc";
	$admin = new AdminLayout;

  	session_start();


  	//검색용 데베
  	$connect =mysqli_connect('localhost','bitnami','1234','event') or die('connection fail');
  	$date=$_POST['date'];
  	$finalDate=$_POST['finalDate'];

  	$date1 = date( 'Y-m-d', strtotime( $date ) );
	$date2 = date( 'Y-m-d', strtotime( $finalDate) );

	$query="SELECT * FROM eventdb WHERE date>= '$date1' AND finalDate<='$date2'	";
	$result = $connect->query($query);
	$total=mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
<head>
		<?php $admin->AdminLayoutStyle();?>
</head>
<body>
	<?php 
    $admin->AdminLayoutHeader();
    $admin->AdminLayoutMenu();
  ?>
   <article><center>
   	<h2 align="center"><?php echo "{$date1}부터 {$date2}"?>까지 기간검색</h2>
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
		<td><a href="admineventview.php?number=<?php echo $rows['number']?>"><?php echo $rows['title']?></td>
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
    $admin->AdminLayoutFooter();
  ?>
</body>
</html>
