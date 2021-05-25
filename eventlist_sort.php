<?php 
	$connect =mysqli_connect('localhost','bitnami','1234','event') or die('connection fail');
$output = '';  
 $order = $_POST["order"];  
 if($order == 'desc')  
 {  
      $order = 'asc';  
 }  
 else  
 {  
      $order = 'desc';  
 }  
 $query = "SELECT * FROM eventdb ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";  
 $result = mysqli_query($connect, $query);  
 $output .= '  
 <table class="table table-bordered">  
      <tr>  
           <th><a class="column_sort" id="number" data-order="'.$order.'" href="#">번호</a></th>  
           <th><a class="column_sort" id="title" data-order="'.$order.'" href="#">제목</a></th>  
           <th><a class="column_sort" id="date" data-order="'.$order.'" href="#">날짜</a></th>  
           <th><a class="column_sort" id="finalDate" data-order="'.$order.'" href="#">유효기간</a></th>  
           <th><a class="column_sort" id="hit" data-order="'.$order.'" href="#">조회수</a></th>  
      </tr>  
 ';  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
      <tr>  
           <td>' . $row["number"] . '</td>  
           <td>' . $row["title"] . '</td>  
           <td>' . $row["date"] . '</td>  
           <td>' . $row["finalDate"] . '</td>  
           <td>' . $row["hit"] . '</td>  
      </tr>  
      ';  
 }  
 $output .= '</table>';  
 echo $output;  
 ?>  