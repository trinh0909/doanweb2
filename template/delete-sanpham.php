<?php
include 'ketnoi.php';
if(isset($_GET['id'])){
    echo '1';
    $id = $_GET['id'];
    $sql = "UPDATE tbl_sanpham set isDel = 1 where MaSanPham = $id";
    if(mysqli_query(kn(),$sql)){
        header('Location:quanlysp.php');
    }
}

?>