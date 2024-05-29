<?php
    session_start();
?>
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
    <div class="dathang giohang">
        <h1>THÔNG TIN ĐẶT HÀNG</h1>
        <div class = "dh">
        <div class = "ttkh">
        <h2>THÔNG TIN</h2>
            <!-- <input type="text" name="" id="" value=""> -->
            <?php
            include 'ketnoi.php';
            // if(isset($_SESSION['giohang'])){
            //     for($i=0;i<count($_SESSION['giohang']);$i++)
            //         $sql ="INSERT INTO tbl_chitiethoadon
            //         VALUES (mhd, sl, gia,msp)";
            //         $kq = mysqli_query(kn(),$sql);
            // }
            if(isset($_SESSION['user'])){
                $a = $_SESSION['user'];
                $sql ="SELECT * FROM tbl_taikhoan where TenDangnhap = '$a'";
                $kq = mysqli_query(kn(),$sql);
                if($kq->num_rows)
                {
                    $pq = mysqli_fetch_array($kq);
                    $mkh= $pq['MaKhachHang'];
                    // $mkh = "kh124";
                    $sql ="SELECT * FROM tbl_khachhang where MaKhachHang = '$mkh'";
                    $kq = mysqli_query(kn(),$sql);
                    $pq = mysqli_fetch_array($kq);
                    echo '<p>Họ Tên</p> <input type="text" name="" id="ten" value="'.$pq['TenKhachHang'].'">';
                    echo ' <p>Số Điện Thoại</p><input type="text" name="" id="sdt" value="0'.$pq['SDTKhachHang'].'">';
                    echo ' <p>Địa Chỉ</p><input type="text" name="" id="dc" value="'.$pq['DCKhachHang'].'">';
                }

            }
            ?>
            <div class = "btdieuhuong">
            <div><a id="ttdathang">Đặt hàng</a></div>
            <div><a href="chitietgiohang.php" >Đóng</a></div>
        </div>
        </div>
        <div class="sanpham">
        <table border="1" class="tbgiohang" width="100%">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                   
                </tr>
               
            <?php
                // for($i=0;i<count($_SESSION['giohang']);$i++)
                if(isset($_SESSION['giohang'])){
                    $gia = 0;
                    $tong = 0;
                    for($i = 0; $i< count($_SESSION['giohang']);$i++)
                        {
                            $temp = $_SESSION['giohang'][$i]['Gia'];
                            for($j = 0; $j<strlen($temp);$j++){
                                if($temp[$j] == ".")
                                   for($k = $j;$k <strlen($temp)-1;$k++)
                                    {
                                        $temp[$k] = $temp[$k+1];
                                    }

                            }
                            $temp[strlen($temp)-1]= " ";
                            $temp = (int)trim($temp);
                           $tong =$tong+$temp*$_SESSION['giohang'][$i]['sl']; 
                            $a = $i+1;
                            echo '<tr align="center"> 
                            <td>'.$a.'</td>
                            <td>'.$_SESSION['giohang'][$i]['TenSanPham'].'</td>
                            
                            <td><input type ="number" name = sl'.$i.' value = "'.$_SESSION['giohang'][$i]['sl'].'" id="slgh"></td>
                            <td>'.$_SESSION['giohang'][$i]['Gia'].'</td>
                            </tr>';
                          }
                          $a = 3;
                          for($i =0;$i<strlen($tong);$i++){
                            if($i==$a){
                                $tong = substr_replace ( $tong,".", -$i, 0 ) ; 
                                $a=$a+4;

                            }
                          }
                        echo '
                        <tr>
                        <td colspan="4" align="right" >Tổng: '.$tong.'</td>
                        <input type="hidden" id = "tong" value ="'.$tong.'"> 
                    </tr>
                        ';

              }
            ?>  
        </div>
        </div>
    </div>
</body>
</html>
<script>
     $(document).ready(function() {
           $('#ttdathang').on( "click", function(event) {
                var tongtien = document.getElementById('tong').value;
               var ht = document.getElementById('ten').value;
               var sdt = document.getElementById('sdt').value;
               var dc = document.getElementById('dc').value;
               $.ajax({
                    type: 'POST',
                    url: "xulydathang.php",
                    data: 'ten='+ht+'&sdt='+sdt+'&dc='+dc+'&tongtien='+tongtien,
                    success: function(result){
                    //    alert(result);
                        console.log(result);
                       window.location.href = '../index.php';
                    }
                })
             })
         })
</script>