
<?php
    session_start();

    $num = $_POST['num'];
    $name = $_POST['name'];
    $postcode = $_POST['postcode'];
    $address = $_POST['address'];
    $detailAddress = $_POST['detailAddress'];
    $extraAddress = $_POST['extraAddress'];
    $phoneNum = $_POST['phoneNum'];
    $isDefault = $_POST['isDefault'];
    $id = $_SESSION['id'];

    $num_test = preg_match('/^(010)[0-9]{4}[0-9]{4}/', $phoneNum);
    if(!$name || !$postcode || !$address || !$detailAddress || !$phoneNum){
        echo "<script>
            alert('입력되지 않은 정보가 존재합니다.');
            location.href='myPageDest.php';
            exit();
        </script>";
    }
    else if(strlen($phoneNum) != 11 || !$num_test){
        echo "<script>
            alert('연락처 형식에 맞지 않습니다.');
            location.href='myPageDest.php';
            exit();
        </script>";
    }
    else{
        $db_conn = mysqli_connect('localhost', 'bitnami', '1234', 'Destination') or die('fail');
        if($isDefault){
            $sql_default = "UPDATE desInfo SET defaultDes = 0 WHERE id = '$id';";
            mysqli_query($db_conn, $sql_default);
            $sql = "UPDATE desInfo SET name='$name', postcode='$postcode', address='$address', detailAddr='$detailAddress', extraAddr = '$extraAddress', phoneNum='$phoneNum', defaultDes=1 WHERE NUM='$num';";
        }
        else{
            $sql = "UPDATE desInfo SET name='$name', postcode='$postcode', address='$address', detailAddr='$detailAddress', extraAddr = '$extraAddress', phoneNum='$phoneNum', defaultDes=0 WHERE NUM='$num';";
        }
        $query_res = mysqli_query($db_conn, $sql);

        if($query_res){
            echo "<script>
                alert('정상적으로 수정되었습니다.');
                location.href='myPageDest.php';
                exit();
            </script>";
        }
        else{
            echo "<script>
                alert('배송지 정보 수정에 실패했습니다.');
                location.href='myPageDest.php';
                exit();
            </script>";
        }
    }
?>