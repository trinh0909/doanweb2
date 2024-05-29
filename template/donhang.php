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
    <div class="donhan giohang">
        <h1>ĐƠN HÀNG</h1>
        <div class="thoigian">
            <input type="date" name="batdau" id="batdau">
            <input type="date" name="ketthuc" id="ketthuc">
            <button id="btloc">Lọc</button>
        </div>
        <divc  id="htspam">
            <?php
                include 'ketnoi.php';
                $sql ="SELECT * FROM tbl_hoadon";
                if($kq = mysqli_query(kn(),$sql)){
                     $i=0;
                     echo '<table border="1" class="tbgiohang" width="100%">
                     <th>STT</th>
                     <th>Mã Hóa Đơn</th>
                     <th>Tổng Tiền</th>
                     <th>Trạng Thái đơn hàng</th>
                     <th>Chi Tiết</th>
                     ';
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
                        echo '<td><a href="chitietdonhang.php?chitiet='.$rows['MaHoaDon'].'">Xem</a></td>';
                        echo '</tr>';
                    }
                }
            ?>
            </table>
        </div>
        <div class="back">
            <button><a href="quantri.php">Quay Lại</a></button>
        </div>
    </div>
</body>
</html>
<script>
          $(document).ready(function() {
            $('#btloc').on( "click", function(event) {
            var batdau = $('#batdau').val();
            var ketthuc = $('#ketthuc').val();
            $.ajax({
                    url: "xulyadmin.php",
                    type: 'POST',
                    data: 'batdau='+batdau+'&ketthuc='+ketthuc,
                    success: function(result){
                      $('#htspam').html(result);
                    }
                })
                event.preventDefault();
            })
        })
</script>   