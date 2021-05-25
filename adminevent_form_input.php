<?php
	error_reporting(E_ALL);
	ini_set( "display_errors", 1 );

extract($_REQUEST);


	if($_FILES['userImage']['error']>0 ){
		echo "<script>alert('파일 업로드 에러');
		history.back()
		</script>";}
	else{
		if (is_uploaded_file($_FILES['userImage']['tmp_name']))
			{
			$conn =mysqli_connect('localhost','bitnami','1234','event') or die('connection fail');
			$title=addslashes($title);
			$finalDate=addslashes($finalDate);
			$content=addslashes($content);
			$date = date('Y-m-d H:i:s');

			$URL = './adminevent_list.php';

			$imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
	        $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);

			$sql = "INSERT INTO eventdb(number,title,content,date,finalDate,hit,imageType,imageData)VALUES (null,'$title','$content','$date','$finalDate',0,'{$imageProperties['mime']}', '{$imgData}')";


			$current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> 이미지 에러!<br/>" . mysqli_error($conn));
			if (isset($current_id)) {
				?><script>
			alert("<?php echo"이벤트 글 등록되었습니다."?>");
			 location.href="adminevent_list.php";
				</script><?php
		         
		        }



			}

	   	}

	?>