
<?php
    session_start();
    if(isset($_GET['dathang'])){
        if(!isset($_SESSION['giohang'])|| count($_SESSION['giohang']) ==0)
        echo "2";

        else if(isset( $_SESSION['user'] )){
            echo "1";
        }
        else echo "0";
    }
if(isset($_POST['capnhat'])){
    for($i = 0; $i< count($_SESSION['giohang']);$i++){
        if($_POST['sl'.$i] > 0)
        {
         $_SESSION['giohang'][$i]['sl'] = $_POST['sl'.$i];
        }
    }
    header("Location:chitietgiohang.php");
}
if(isset($_GET['xoasp'])){
    if( count($_SESSION['giohang']) == 1){
        unset($_SESSION['giohang'][0]);
        }
    else{
        for($i = $_GET['xoasp']; $i< count($_SESSION['giohang'])-1;$i++)
        {
            $_SESSION['giohang'][$i] = $_SESSION['giohang'][$i+1];
        }
        $k = count($_SESSION['giohang'])-1;
        unset($_SESSION['giohang'][$k]);
    }
    header("location:chitietgiohang.php");
   
}
//đặt hàng
    if(isset($_POST['ten'])){
    if(isset($_SESSION['user'])){
        include 'ketnoi.php';
        $tk = $_SESSION['user'];
        $sql ="SELECT MaKhachHang FROM tbl_taikhoan where TenDangNhap = '$tk'";
        $kq = mysqli_query(kn(),$sql);
        if($kq->num_rows){
            $rows= mysqli_fetch_array($kq);
            $mkh=$rows['MaKhachHang'];
            $sql ="SELECT * FROM tbl_hoadon";
            $kq = mysqli_query(kn(),$sql);
            $mhd = 1;
                if($kq->num_rows){
                    while($rows= mysqli_fetch_array($kq)){
                    $mhd = $rows['MaHoaDon'];
                   }
                   $mhd++;
                }
                $date = getdate(); 
                $thoigian = $date['year'].'-'.$date['mon'].'-'.$date['mday'];
                $ten = $_POST['ten'];
                $sdt = $_POST['sdt'];
                $dc = $_POST['dc'];
                $tong = $_POST['tongtien'];
            $sql ="INSERT INTO tbl_hoadon VALUES ('$mhd', '$mkh',' $thoigian','$tong','$ten','$sdt','$dc',3)";
            if($kq = mysqli_query(kn(),$sql))
            {
                if(isset($_SESSION['giohang'])){
                    for($i = 0; $i< count($_SESSION['giohang']);$i++){
                        $sl = $_SESSION['giohang'][$i]['sl'];
                        $gia = $_SESSION['giohang'][$i]['Gia'];
                        $masp = $_SESSION['giohang'][$i]['MaSanPham'];
                        $sql1 ="INSERT INTO tbl_chitiethoadon VALUES ('$mhd','$sl', '$gia','$masp')";
                        $kq1 = mysqli_query(kn(),$sql1);
                        // if($kq1 = mysqli_query(kn(),$sql1)){
                        //     unset($_SESSION['giohang'][$i]);
                        //     // echo "Đặt hàng thành công";
                        // }
                    }
                    
                    }
                }
            }
            // else echo 1;

        }
        // echo count($_SESSION['giohang']);
        if(isset($_SESSION['giohang']))
        unset($_SESSION['giohang']);
    }
// xác nhận hàng 
if(isset($_POST['donhang'])){
    include 'ketnoi.php';
    $mdh = $_POST['donhang'];
    $sql ="UPDATE tbl_hoadon
    SET TrangThai = 1
    WHERE MaHoaDon = '$mdh'";
    if($kq = mysqli_query(kn(),$sql))
    echo 1;
    else echo 0;
}
?>