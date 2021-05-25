<?php

   $conn = mysqli_connect(
  'localhost',      //주소
  'bitnami',        //username
  '1234',           //pw
  'book'            //database_name
 ) or die('fail');

  //bookdata input bookdata(category, cate_dec, book_name, book_detail, author, price)
  $category = $_POST['category'];
  $cate_dec = $_POST['cate_dec'];
  $book_name = $_POST['book_name'];
  $book_detail = $_POST['book_detail'];
  $author = $_POST['author'];
  $price = $_POST['price'];

  //bookdata input upfile(book_image, imageData)
  error_reporting(E_ALL);
  ini_set( "display_errors", 1 );
  extract($_REQUEST);

  if(!$book_name || !$author || !$price || !$book_detail || ($_FILES['book_image']['error']>0)){
    echo "<script>
        alert('필수정보가 입력되지 않았습니다.');
        history.back();
        exit();
        </script>";
  }

  else{
    $sql1 = "INSERT INTO bookdata (category, cate_dec, book_name, book_detail, author, price) VALUES('$category', '$cate_dec', '$book_name', '$book_detail', '$author', '$price');";

   $result1 = mysqli_query($conn, $sql1);
  }


  if($result1 == false){
    echo '저장 error(책정보 문제)';
    error_log(mysqli_error($conn));
  }
  else{
    if (is_uploaded_file($_FILES['book_image']['tmp_name']))
      {
        $imgData = addslashes(file_get_contents($_FILES['book_image']['tmp_name']));
        $imageProperties = getimageSize($_FILES['book_image']['tmp_name']);

        $sql2 = "INSERT INTO upfile(book_image, imageData) VALUES ('{$imageProperties['mime']}', '{$imgData}')";

      $current_id = mysqli_query($conn, $sql2) or die("<b>Error:</b> Problem on Image Insert<br>" . mysqli_error($conn));
      if (isset($current_id)) {
        ?><script>
      window.parent.location.href="book_list.php";
        </script><?php
      }
    }
  }
?>
