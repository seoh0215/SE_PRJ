<?php

	include_once "adminLayout.inc";
	$admin = new AdminLayout;
?>
<!DOCTYPE html>
<html>
<head>
	<?php $admin->AdminLayoutStyle(); ?>
</head>
<body>
	<?php
		$admin->AdminLayoutHeader();
		$admin->AdminLayoutMenu();
	?>
	<article>
		<h1>관리자 화면 메인 페이지입니다.</h1>
	</article>
	<?php
		$admin->AdminLayoutFooter();

	?>
</body>
</html>