<?php
//필요없음
    session_start();

    #$amount = $_POST['result'];
    #$index = $_POST['index'];
    $id = $_SESSION['id'];

    $yesno_conn = mysqli_connect('localhost', 'bitnami', '1234', 'shoppingbasket') or die('fail');
    $yesno_sql = "SELECT id FROM basket";

    
    $yesno_result = mysqli_query($yesno_conn, $yesno_sql);

    while($check = mysqli_fetch_array($yesno_result)){

        if($_SESSION['id'] == $check['id']){
            #결제창으로 연결해라
            echo "<script>
                location.href='mainPage.php';
                exit();
            </script>";
        }
        else{
            echo "<script>
                alert('장바구니에 등록된 상품이 없습니다');
                history.back();
            </script>";
        }
    }
?>