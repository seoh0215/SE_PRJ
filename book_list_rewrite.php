  <?php

    session_start();

      $category = $_POST['category'];
      $cate_dec = $_POST['cate_dec'];
      $book_name = $_POST['book_name'];
      $book_detail = $_POST['book_detail'];
      $author = $_POST['author'];
      $price = $_POST['price'];
      $book_num = $_POST['rewrite_book_num'];
      $image_num = $_POST['rewrite_book_num'];

    if (!$book_name || !$author || !$price || !$book_detail ||($_FILES['book_image']['error']>0)){
        echo "<script>
            alert('입력되지 않은 정보가 존재합니다.');
            location.href='book_list_upload.php';
            exit();
        </script>";
    }

    else{
           $conn = mysqli_connect('localhost','bitnami','1234','book') or die('fail');

           $sql1 = "UPDATE bookdata SET category = '$category', cate_dec = '$cate_dec', book_name = '$book_name', book_detail = '$book_detail', author = '$author', price = '$price' WHERE book_num = '$book_num'";

           $result1 = mysqli_query($conn, $sql1);

            if($result1 == false){
                echo '저장 error(책정보 문제)';
                error_log(mysqli_error($conn));
            }

            else{
                if (is_uploaded_file($_FILES['book_image']['tmp_name']))
                {
                    $imgData = addslashes(file_get_contents($_FILES['book_image']['tmp_name']));
                    $imageProperties = getimageSize($_FILES['book_image']['tmp_name']);
                    $sql2 = "UPDATE upfile SET book_image = '{$imageProperties['mime']}', imageData = '{$imgData}' WHERE image_num = '$image_num'";
                    $current_id = mysqli_query($conn, $sql2) or die("<b>Error:</b> Problem on Image Insert<br>" . mysqli_error($conn));

                    if (isset($current_id)) {
                        ?><script>
                            alert("책정보 수정 성공");
                            window.parent.location.href="book_list.php";
                            </script><?php
                        }
                    }
                }
            }
?>