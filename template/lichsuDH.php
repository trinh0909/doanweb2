<?php
session_start();
    if(isset($_GET['lsdh'])){
        if(isset($_SESSION['user'])){
            echo 1;
        }
        else echo 0;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/jquery-3.6.4.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class ="lichsu giohang">
        <h1>LỊCH SỬ MUA HÀNG</h1>
        <div class = "btdieuhuong">
        <div><a href="lichsuDH.php?trangthai=xn" id="dondathangxn">Đơn hàng chờ xác nhận</a></div>
        <div><a href="lichsuDH.php?trangthai=dh" id="dondathang">Đơn hàng</a></div>
        <div><a href="lichsuDH.php?trangthai=xdh" >Đã đặt hàng</a></div>
        <div><a href="../index.php" >Đóng</a></div>
    </div>
    <br>
        <div>
            <!-- <table border="1">
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Ngày đặt hàng</th> -->
            
            <?php
             include 'ketnoi.php';
                if(isset($_SESSION['user'])){
                    $a = $_SESSION['user'];
                    $sql ="SELECT * FROM tbl_taikhoan where TenDangnhap = '$a'";
                    $kq = mysqli_query(kn(),$sql);
                    if($kq->num_rows)
                    {
                        $pq = mysqli_fetch_array($kq);
                        $mkh= $pq['MaKhachHang'];
                        if(isset($_GET['trangthai'])){
                            if($_GET['trangthai'] =='dh')
                                $trangthai = 0;
                            else if($_GET['trangthai'] =='xdh')
                                $trangthai = 1;
                            else if($_GET['trangthai'] =='xn')
                            $trangthai = 3;
                            $sql ="SELECT * FROM tbl_hoadon where MaKhachHang = '$mkh' AND TrangThai = '$trangthai'";
                            $kq = mysqli_query(kn(),$sql);
                            while($pq = mysqli_fetch_array($kq)){
                                $i=0;
                                echo '<div class="sanpham_lichsu"> <table border="1" class = "tbgiohang">
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Ngày đặt hàng</th>';
                                $ngaydat= $pq['NgayDatHang'];
                                 $mhd = $pq['MaHoaDon'];
                                 $sql1 ="SELECT * FROM tbl_sanpham INNER JOIN tbl_chitiethoadon
                              ON tbl_sanpham.MaSanPham = tbl_chitiethoadon.MaSanPham 
                              AND tbl_chitiethoadon.MaHoaDon = '$mhd'";
                                $kq1 = mysqli_query(kn(),$sql1);
                                while($rows = mysqli_fetch_array($kq1))
                                    {
                                        $i++;
                                        echo '<tr><td>'.$i.'</td>
                                            <td>'.$rows['TenSanPham'].'</td>
                                             <td>'.$rows['SoLuongDatHang'].'</td>
                                            <td>'.$rows['Giá'].'</td>
                                            <td class="edit">'.$ngaydat.'</td>
                                            </tr>';
                                    }
                                echo '<tr><td colspan="5" align="right">Tổng: '.$pq['TongTien'].'000đ</td> </tr>';
                            echo '</table>';
                            if($trangthai == 0)
                            {
                            echo '<button id="dh'.$mhd.'">Đã nhận được hàng</button> <br><br>';
                            echo '</div>';
                            }
                            }
                         }
                        else{
                        $sql ="SELECT * FROM tbl_hoadon where MaKhachHang = '$mkh'";
                        $kq = mysqli_query(kn(),$sql);
                        while($pq = mysqli_fetch_array($kq)){
                            $i=0;
                            $trangthai = $pq['TrangThai'];
                            echo '<div class="sanpham_lichsu"> <table border="1" class = "tbgiohang">
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Ngày đặt hàng</th>';
                            $ngaydat= $pq['NgayDatHang'];
                             $mhd = $pq['MaHoaDon'];
                             $sql1 ="SELECT * FROM tbl_sanpham INNER JOIN tbl_chitiethoadon
                          ON tbl_sanpham.MaSanPham = tbl_chitiethoadon.MaSanPham 
                          AND tbl_chitiethoadon.MaHoaDon = '$mhd'";
                            $kq1 = mysqli_query(kn(),$sql1);
                            while($rows = mysqli_fetch_array($kq1))
                                {
                                    $i++;
                                    echo '<tr><td>'.$i.'</td>
                                        <td>'.$rows['TenSanPham'].'</td>
                                         <td>'.$rows['SoLuongDatHang'].'</td>
                                        <td>'.$rows['Giá'].'</td>
                                        <td class="edit">'.$ngaydat.'</td>
                                        </tr>';
                                        
                                }
                                
                            echo '<tr><td colspan="5" align="right">Tổng: '.$pq['TongTien'].'000đ</td> </tr>';
                        echo '</table>';
                        if($trangthai == 0)
                            {
                            echo '<button id="dh'.$mhd.'">Đã nhận được hàng</button> <br><br>';
                            echo '</div>';
                            }
                        }
                        }
                    }
    
                }
            ?>
            
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function() {
           $('div.lichsu button').on( "click", function(event) {
                 var mdh = $(event.target).attr('id');
                 var str = mdh.slice(2);
                 $.ajax({
                    type: 'POST',
                    url: "xulydathang.php",
                    data: 'donhang='+str,
                    success: function(result){
                        console.log(result);
                        window.location.href = 'lichsuDH.php?trangthai=dh';
                    }
                })
                 event.preventDefault();
             })
         })
</script>
