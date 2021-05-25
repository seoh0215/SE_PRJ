<?php

	error_reporting(E_ALL);
	ini_set( "display_errors", 1 );
	$conn = mysqli_connect('localhost','bitnami','1234','book') or die('fail');
	$book_num = $_POST['is_delete'];

	$sql = "UPDATE bookdata SET is_delete = 1 WHERE book_num = '$book_num'";
	$result = mysqli_query($conn, $sql);

	if($result){
		echo "<script>alert('정상적으로 삭제되었습니다.');
		location.href='book_list.php';</script>";
	}

?>