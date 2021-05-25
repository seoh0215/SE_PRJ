<?php
	require_once './layout.inc';
	$base = new Layout;
	session_start();

	$base->style = "
		#myInfo{
			width: 12%;
			height: 80px;

			float: left;
			padding-top: 45px;
			margin-left: 20%;
			background: rgb(70, 190, 250); 
			display: inline-block;'
		}
		#info_des{
			margin-top: 35px;
			margin-left: 25px;
			display: inline-block;
			float: left;
		}
		#info_des a{ 
			text-decoration: none;
			color: black; 
		}
	";

	$base->content = "
		<div>
			<div id = 'myInfo'>My정보</div>
			<div id = 'info_des'>
				<ul>
					<li><a href='myPageDest.php'>배송지 관리</a></li>
					<li><a href='myPageOrder.php'>주문내역</a></li>
				</ul>
			</div>
		</div>
	";

	$base->LayoutMain();
?>