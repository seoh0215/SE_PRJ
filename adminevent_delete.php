<?php
    session_start();

    $number = $_GET['number'];

    $db_conn = mysqli_connect('localhost', 'bitnami', '1234', 'event') or die('connection_fail');

    $sql = "DELETE FROM eventdb WHERE number=$number";
    $query_res = mysqli_query($db_conn, $sql);
    if($query_res){
        echo "<script>
            alert('정상적으로 삭제되었습니다.');
            location.href='adminevent_list.php';
            exit();
        </script>";
    }
    else{
        echo "<script>
            alert('배송지 정보 삭제에 실패했습니다.');
            history.back();
            exit();
        </script>";
    }
?>