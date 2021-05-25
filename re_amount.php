<?php
    session_start();

    $amount = $_POST['result'];
    $index = $_POST['index'];
    $id = $_SESSION['id'];

    $db_conn = mysqli_connect('localhost', 'bitnami', '1234', 'shoppingbasket') or die('fail');
    $sql = "UPDATE basket SET basketbook_amount='$amount' WHERE basketbook_index = '$index' ";

     /*WHERE id='$id';*/
    $query_res = mysqli_query($db_conn, $sql);

        if($query_res){
            echo "<script>
                
                location.href='basket.php';
                exit();
            </script>";
        }
        else{
            echo "<script>
                alert('수량 등록에 실패했습니다.');
                location.href='basket.php';
                exit();
            </script>";
        }

        #alert('정상적으로 수정되었습니다.');
?>
