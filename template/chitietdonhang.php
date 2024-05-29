<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class = "giohang">
        <h1>CHI TIẾT ĐƠN HÀNG</h1>
        <div>
        <table border="1" class="tbgiohang" width="100%">
                     <th>STT</th>
                     <th>Mã Hóa Đơn</th>
                     <th>Tên Sản Phẩm</th>
                     <th>Số Lượng</th>
                     <th>Giá</th>
        
        <?php
            if(isset($_GET['chitiet'])){
                include 'ketnoi.php';
                $mhd = $_GET['chitiet'];
                $sql ="SELECT * FROM tbl_chitiethoadon INNER JOIN tbl_sanpham 
                       ON tbl_chitiethoadon.MaSanPham = tbl_sanpham.MaSanPham 
                       AND tbl_chitiethoadon.MaHoaDon = '$mhd'
                       INNER JOIN tbl_hoadon ON tbl_chitiethoadon.MaHoaDon = tbl_hoadon.MaHoaDon
                       ";
                $kq = mysqli_query(kn(),$sql);
                $i = 0;
                $tong = 0;
                while ($rows= mysqli_fetch_array($kq)){   
                    $i++;
                  echo '<tr>
                  <td>'.$i.'</td>
                  <td>'.$rows['MaHoaDon'].'</td>
                  <td>'.$rows['TenSanPham'].'</td>
                  <td>'.$rows['SoLuongSanPham'].'</td>
                  <td>'.$rows['Giá'].'</td>
                  ';
                    echo '</tr>';
                    $tong = $rows['TongTien'];
                }
                echo '<tr>
                <td colspan="5" align="right">Tổng: '.$tong.'000đ</td>
                </tr>';
            }
           
        ?>
        </table>
        </div>
        <div class="back">
            <button><a href="donhang.php">Quay Lại</a></button>
        </div>
    </div>
</body>
</html>