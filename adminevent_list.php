<?php

	include_once "adminLayout.inc";
	$admin = new AdminLayout;

  	session_start();


  	//데베
	$connect =mysqli_connect('localhost','bitnami','1234','event') or die('connection fail');
	$query="select * from eventdb order by number desc";
	$result = $connect->query($query);
	$total=mysqli_num_rows($result);

?>
<html>

<head>
	<?php $admin->AdminLayoutStyle();?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
            
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
</head>
<body>
	 <?php 
    $admin->AdminLayoutHeader();
    $admin->AdminLayoutMenu();
  ?>

  <article><center>
<script type="text/javascript">
	 function checkForm()
  { 
    form=document.search;
    if(form.date.value==''){
    	alert("시작 날짜 입력");
    	form.date.focus();
    	return false;
    }
    if(form.finalDate.value==''){
    	alert("종료 날짜 입력");
    	form.finalDate.focus();
    	return false;
    }
    if(form.date.value>form.finalDate.value){
    	alert("종료일이 시작일보다 빠름!");
    	form.date.focus();
    	return false;
    }

  }

</script>

<div id="search_box">
    <form id="search" name="search" action="adminevent_search.php" method="post" onsubmit="return checkForm()">
    날짜 범위 입력
    <input type="date" name="date" >부터 
    <input type="date" name="finalDate">

	<input type="submit" value="검색" />
    </form>
    </div>

<h2 align="center">공지/이벤트 관리 게시판</h2>
<h3 align="center" style="color: gray">이벤트 일 경우 [이벤트]태그, 공지일 경우 [공지] 태그 입력</h3>
<div id=adminlist class="table-responsive">
<table class="table table-bordered">
	<thead>
		<tr>
			<td><a class="column_sort" id="number" data-order="desc" href="#">번호</td>
			<td><a class="column_sort" id="title" data-order="desc" href="#">제목</td>
			<td><a class="column_sort" id="date" data-order="desc" href="#">날짜</td>
			<td><a class="column_sort" id="finalDate" data-order="desc" href="#">유효기간</td>
			<td><a class="column_sort" id="hit" data-order="desc" href="#">조회수</td>
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
		<td><?php echo $rows['number']?></td>
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
</div>
<div>
	<button onclick=window.parent.location.href="adminevent_form.php";>글 작성</button>
</div>
</center></article>
  <?php
    $admin->AdminLayoutFooter();
  ?>
</body>
</html>
<script>  
 $(document).ready(function(){  
      $(document).on('click', '.column_sort', function(){  
           var column_name = $(this).attr("id");  
           var order = $(this).data("order");  
           var arrow = '';  
           //glyphicon glyphicon-arrow-up  
           //glyphicon glyphicon-arrow-down  
           if(order == 'desc')  
           {  
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>';  
           }  
           else  
           {  
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';  
           }  
           $.ajax({  
                url:"eventlist_sort.php",  
                method:"POST",  
                data:{column_name:column_name, order:order},  
                success:function(data)  
                {  
                     $('#adminlist').html(data);  
                     $('#'+column_name+'').append(arrow);  
                }  
           })  
      });  
 });  
 </script>
