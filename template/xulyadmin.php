<?php
    if(isset($_POST['ketthuc'])){
        include 'ketnoi.php';
        $bd = $_POST['batdau'];
        $kt = $_POST['ketthuc'];
        $sql ="SELECT * FROM tbl_hoadon where NgayDatHang BETWEEN '$bd' AND '$kt'";
        if($kq = mysqli_query(kn(),$sql)){
            echo '<table >
                <th>STT</th>
                <th>Mã Hóa Đơn</th>
                <th>Tổng Tiền</th>
                <th>Trạng Thái đơn hàng</th>
            ';
             $i=0;
            while ($rows= mysqli_fetch_array($kq)){
                $i++;
              echo '<tr>
              <td>'.$i.'</td>
              <td>'.$rows['MaHoaDon'].'</td>
              <td>'.$rows['TongTien'].'</td>';
              if($rows['TrangThai'] == 3)
                   {
                    $trangthai = 'xử lý';
                    echo '<td><a href="xulyadmin.php?xuly='.$rows['MaHoaDon'].'">'.$trangthai.'</a></td>';
                   }
                else if($rows['TrangThai'] == 1)
                {
                 $trangthai = 'Đã nhận hàng';
                 echo '<td>'.$trangthai.'</td>';
                }
                else {
                    $trangthai = 'đã xử lý';
                    echo '<td>'.$trangthai.'</td>';
                }
                echo '</tr>' ;
            }
            echo ' </table>';
        }
        else echo 0;
    }
    if(isset($_GET['xuly'])){
        include 'ketnoi.php';
        $mhd = $_GET['xuly'];
        $sql =" UPDATE tbl_hoadon
        SET TrangThai = 0
        WHERE MaHoaDon = '$mhd'";
        $kq = mysqli_query(kn(),$sql);
        header("Location:donhang.php");
    }
    if(isset($_GET['chitiet'])){
        include 'ketnoi.php';
        $mhd = $_GET['chitiet'];
        $sql ="SELECT * FROM tbl_chitiethoadon where  WHERE MaHoaDon = '$mhd'";
        $kq = mysqli_query(kn(),$sql);
        header("Location:donhang.php");
    }
?>