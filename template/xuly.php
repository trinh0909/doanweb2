<?php
session_start();
if(isset($_POST['ts1'])&&isset($_POST['ts2'])){
    $user = $_POST['ts1'];
    $pass = $_POST['ts2'];
    include 'ketnoi.php';
    $sql ="select * from tbl_taikhoan where TenDangNhap ='$user' and MatKhau ='$pass'";
    $kq = mysqli_query(kn(),$sql);
    if($kq->num_rows){
        if($pq = mysqli_fetch_array($kq)){
         $_SESSION['user'] = $_POST['ts1'] ;
         $_SESSION['pass'] = $_POST['ts2'];
         echo $pq['PhanQuyen'];
        }
    }
    else echo 10;
}
if(isset($_POST['ht'])&&isset($_POST['sdt'])&&isset($_POST['user'])&&isset($_POST['pass'])&&isset($_POST['nl'])&& isset($_POST['dc']))
{
    include 'ketnoi.php';
    $ht = $_POST['ht'];
    $sdt = $_POST['sdt'];
    $pass = $_POST['pass'];
    $nl =$_POST['nl'];
    $dc = isset($_POST['dc']);
    $user = $_POST['user'];
    $sql ="select * from tbl_taikhoan where TenDangNhap ='$user'";
    $kq = mysqli_query(kn(),$sql);
    if($kq->num_rows > 0){
        echo "0";
    }
    else if(is_numeric($sdt)==false || strlen($sdt) > 10 || strlen($sdt) <10 || $sdt[0]!=0){
      echo "4";
    }
    else if(trim($pass) != trim($nl)){
        echo "3";
    }
    else {
        $sql ="select * from tbl_khachhang";
        $kq = mysqli_query(kn(),$sql);
        $a = "";
        while($rows= mysqli_fetch_array($kq)){
           $a = $rows['MaKhachHang'];
        }
        $a = (integer)substr($a,2)+1;
        $a = "kh".$a;
        $date = getdate();
        $ngaytao = $date['year']."-".$date['mon']."-".$date['mday'];
        $sql = "INSERT INTO tbl_khachhang VALUES('$a','$ht','$sdt','$dc',0)";
        $kq = mysqli_query(kn(),$sql);
        $sql = "INSERT INTO tbl_taikhoan(TenDangNhap,MatKhau,NgayTao,ThongTinTaiKhoan,PhanQuyen,MaKhachHang)
          VALUES('$user','$pass','$ngaytao','Tài khoản khách hàng',0,'$a')";
         if(mysqli_query(kn(),$sql)){
            echo '1';
         }
         else echo '0';
    }
}
else 
    
?>