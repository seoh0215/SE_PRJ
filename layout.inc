<?php
	class layout{
		public $link; //css 링크 태그
		public $style;
		public $content; //메인 content
		public $board; //게시판
		public $title="book store"; //웹페이지 제목

		//레이아웃 출력
		public function LayoutMain(){
			session_start();
			echo "<!DOCTYPE html>\n<html lang = 'ko'>";

			echo "<head>\n<meta charset = 'utf-8'/>";
			echo "<title>".$this->title."</title>"; //title
			echo $this->LayoutStyle(); //스타일 추가
			echo "</head>";

			echo "<body>\n<div id = 'container'>";
			echo	$this->LayoutHeader(); //header 레이아웃
			echo 	$this->LayoutMenu(); //menu 레이아웃
			echo	$this->LayoutContent(); //content 레이아웃
			echo	$this->LayoutFooter(); //footer 레이아웃
			echo "</div></body>\n</html>";
		}

		//스타일 추가
		public function LayoutStyle(){
			echo "<link rel='stylesheet' type='text/css' href='style.css'>";
			echo "<style>".$this->style."</style>";
		}

		//header 레이아웃 
		public function LayoutHeader(){
			session_start();
			echo "<header>
				<center>
					<h1 style='display: inline-block;'>
					<a href='mainPage.php'><img src='./img/sampleLogo.png' height='100' width='100'></a>
					</h1>
					<div style='display: inline-block;'>

					<form name = 'search_result' method='get' action = 'SearchResult.php'>
						<table id = 'search_box'>
							<th>
								<select id = 'category' name ='category'>
									<option value = 'all'>통합검색</option>
									<option value = 'korea'>국내도서</option>
									<option value = 'foreign'>국외도서</option>
									<option value = 'used'>중고도서</option>
								</select>
							</th>
							<th>
								<input type='text' name='book_name' style='width:20em; height: 2em; border: none;'>
							</th>
							<th>
								<input type='submit' value='검색'>
							</th>
						</table>
							<details style ='font-size:14px' >
								<summary style = 'color:rgb(51, 175, 233);'>가격지정</summary>
									<input type='number' name='price1' min ='0' max = '1000000' > - <input type='number' name='price2' min ='0' max = '1000000'>
							</details>
					</form>
					</div>
					";
			if(!$_SESSION['id'] && !$_SESSION['name']){
				echo "<h5 style='margin-top: 0;'><a href='login.php'>로그인 </a>|<a href='signUpForm.php'> 회원가입</a></h5>";
			}
			else{
				echo "<h5 style='margin-top: 0;'><a href='myPage.php'>".$_SESSION['name']."</a>님, 환영합니다. |<a href='basket.php'> 장바구니 </a>|<a href='logout.php'> 로그아웃</a></h5>";
			}
				echo "</center>
				</header>";
		}

		//menu 레이아웃
		public function LayoutMenu(){
			echo "<ul id = 'menu'>
						<li><a href='SearchResult.php?category=korea'>국내도서</a></li>
						<li><a href='SearchResult.php?category=foreign'>국외도서</a></li>
						<li><a href='SearchResult.php?category=used'>중고도서</a></li>
						<li><a href='eventlist.php'>공지/이벤트</a></li>
				</ul>
				";
		}
		//content 레이아웃
		public function LayoutContent(){
			echo "<article><center>".$this->content."</center></article>";
		}

		//footer 레이아웃
		public function LayoutFooter(){
			echo"<footer>
				<div>
					<a href='team.php'>사업자정보</a> | <a href = 'https://www.law.go.kr/%ED%96%89%EC%A0%95%EA%B7%9C%EC%B9%99/%EB%94%94%EC%A7%80%ED%84%B8%EC%BD%98%ED%85%90%EC%B8%A0%20%EC%9D%B4%EC%9A%A9%20%ED%91%9C%EC%A4%80%EC%95%BD%EA%B4%80'>이용약관</a>
				</div>
				</footer>";
		}
	}
?>