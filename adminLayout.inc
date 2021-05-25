<?php
//url 접근 막기
session_start();
if($_SESSION['id']=='admin'){

	class AdminLayout{
		public $content;
		public $style;

		//레이아웃 출력
		public function AdminLayoutMain(){
			session_start();
			echo "<!DOCTYPE html>";

			echo "<head><meta charset = 'utf-8'/>
					<title>AdminPage</title>
					<link rel='stylesheet' type='text/css' href='adminStyle.css'>
				</head>";

			echo "<body>";
			echo	$this->AdminLayoutHeader(); //header 레이아웃
			echo	$this->AdminLayoutContent(); //content 레이아웃
			echo	$this->AdminLayoutFooter(); //footer 레이아웃
			echo "</body>
				</html>";
		}
		public function AdminLayoutStyle(){
			echo "<link rel='stylesheet' type='text/css' href='adminStyle.css'>";
			echo "<style>".$this->style."</style>";
		}

		//header 레이아웃 
		public function AdminLayoutHeader(){
			session_start();
			echo "<header>
					<div style='display: inline-block; margin-right: 20px; vertical-align: top;'>
						<a href='adminMainPage.php'><img src='./img/sampleLogo.png' height='100' width='100'></a>
					</div>";

					echo"<h1 style='display: inline-block; font-size: 30pt;'>관리자화면</h1>";

					if($_SESSION['id']=='admin'){
					echo"<h3 style='display: inline-block;'><a href='logout.php' style='text-decoration: none;'>-로그아웃</a></h3>";
				    }   
				echo"</header>";
		}

		public function AdminLayoutMenu(){
			echo"
				<ul id = 'menu'>
					<li><a href='book_list.php'>상품 관리</a></li>
					<li><a href='adminevent_list.php'>공지/이벤트 관리</a></li>
				</ul>
			";
		}
		//content 레이아웃
		public function AdminLayoutContent(){
			echo "<article><center>
						".$this->content."
					</center></article>";
		}

		//footer 레이아웃
		public function AdminLayoutFooter(){
			echo"<footer>
					<div>
					<a href='team.php'>사업자정보</a> | <a href = 'https://www.law.go.kr/%ED%96%89%EC%A0%95%EA%B7%9C%EC%B9%99/%EB%94%94%EC%A7%80%ED%84%B8%EC%BD%98%ED%85%90%EC%B8%A0%20%EC%9D%B4%EC%9A%A9%20%ED%91%9C%EC%A4%80%EC%95%BD%EA%B4%80'>이용약관</a>
					</div>
				</footer>";
		}
	}

} else{

	echo "<script>
                alert('잘못된 접근입니다. 관리자 로그인 필요');
                location.href='adminlogin.php';
                exit();
            </script>";
}
?>