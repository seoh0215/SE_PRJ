<?php
	include_once "adminLayout.inc";
	$admin = new AdminLayout;

  	session_start();

?>
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
<form method="post"  enctype="multipart/form-data"  action="adminevent_form_input.php">
	<table border="0" cellpadding="0" width="670">
		<tr>
			<td align="center">
				<font color="green">이벤트 글 작성</font>
			</td>
		</tr>
	</table>
<table>
	<tr>
		<td>제목</td>
		<td><input type="text" name="title" ></td>
	</tr>
	<tr>
		<td>유효기간</td>
		<td><input type="date" name="finalDate"></textarea></td>
	</tr>
	<tr>
		<td>내용</td>
		<td><textarea name="content" cols="85" rows="15" ></textarea></td>
	</tr>
	<tr>
		<td>이미지</td>
		<td><input type="file" name="userImage" /></td>
	</tr>
</table>
<div>
	<input type="submit" value="작성" />
</div>

</form>
	<button class="btn" onclick="location.href='adminevent_list.php'" >목록으로</button>
</center></article>
 <?php
    $admin->AdminLayoutFooter();
  ?>
</body>
</html>
