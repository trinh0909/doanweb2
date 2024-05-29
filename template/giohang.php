<?php
session_start();
if(isset($_GET['masp'])){
    $s =0;
    $msp = $_GET['masp'];
    include 'ketnoi.php';
    $sql ="SELECT SoLuongSanPham FROM tbl_sanpham where MaSanPham = '$msp'";
    $kq = mysqli_query(kn(),$sql);
    if($kq->num_rows >0){
        $rows= mysqli_fetch_array($kq);
        if($_GET['sl']>$rows['SoLuongSanPham']){
            echo $rows['SoLuongSanPham'];
        }
    else {
    $sql ="SELECT * FROM tbl_sanpham where MaSanPham = '$msp'";
    $kq = mysqli_query(kn(),$sql);
    $sl = $_GET['sl'];
    if($kq->num_rows >0){
        $rows= mysqli_fetch_array($kq);
            if(!isset($_SESSION['giohang'])) $_SESSION['giohang'] = array();
            $i = count($_SESSION['giohang']);
            for($i = 0; $i< count($_SESSION['giohang']);$i++)
            {
                if($_SESSION['giohang'][$i]['MaSanPham'] == $rows['MaSanPham'])
                {
                    $_SESSION['giohang'][$i]['sl'] = $_SESSION['giohang'][$i]['sl']+$sl;
                }
                else {
                    $s++;
                }
            }
            if($s == $i){
                $_SESSION['giohang'][$i]['MaSanPham']= $rows['MaSanPham'];
                $_SESSION['giohang'][$i]['TenSanPham'] = $rows['TenSanPham'];
                $_SESSION['giohang'][$i]['img'] = $rows['img'];
                $_SESSION['giohang'][$i]['Gia'] = $rows['Gia'];
                $_SESSION['giohang'][$i]['sl'] = $_GET['sl'];
            }
            if(isset($_SESSION['giohang'])){
                echo '1';
          }else echo 'ppp';
    }
}
}
    
}
?>