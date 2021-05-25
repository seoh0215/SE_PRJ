<?php
    session_start();

    #$amount = $_POST['result'];
    $index = $_POST['index'];
    $delete = $_POST['delete'];
    $id = $_SESSION['id'];

    $db_conn = mysqli_connect('localhost', 'bitnami', '1234', 'shoppingbasket') or die('fail');
    $sql = "DELETE FROM basket WHERE basketbook_index = '$index';";

     /*WHERE id='$id';*/
    $query_res = mysqli_query($db_conn, $sql);

        if($query_res){
            echo "<script>
                alert('삭제되었습니다.');
                location.href='basket.php';
                exit();
            </script>";
        }
        else{
            echo "<script>
                alert('삭제에 실패했습니다.');
                location.href='basket.php';
                exit();
            </script>";
        }

?>