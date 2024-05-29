<?php
    if(isset($_POST['batdau'])){
        include 'ketnoi.php';
        $bd = $_POST['batdau'];
        $kt = $_POST['ketthuc'];
        $temp =0;
        $sql ="SELECT *FROM tbl_hoadon where NgayDatHang BETWEEN '$bd' AND '$kt'";
        if($kq = mysqli_query(kn(),$sql)){
            $a =0;
            echo '<table border="1" class="tbgiohang" width=100%>
            <th>Ngày Đặt hàng</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
        ';
            while ($rows= mysqli_fetch_array($kq)){
                $a++;
                $mhd = $rows['MaHoaDon'];
                $sql1 ="SELECT * FROM tbl_chitiethoadon INNER JOIN tbl_sanpham 
                       ON tbl_chitiethoadon.MaSanPham = tbl_sanpham.MaSanPham 
                       AND tbl_chitiethoadon.MaHoaDon = '$mhd'";
                // echo '<tr>';
                if($kq1 = mysqli_query(kn(),$sql1)) {
                    echo '<tr>   
                    <td rowspan="'.$kq1->num_rows.'">'.$rows['NgayDatHang'].'</td>';
                    // echo '<td rowspan="'.$kq1->num_rows.'">000đ</td>';
                    while ($rows1= mysqli_fetch_array($kq1)){
                  
                        echo '<td>'.$rows1['TenSanPham'].'</td>
                        <td>'.$rows1['SoLuongDatHang'].'</td>
                        <td>'.$rows1['Giá'].'</td>';
                        // echo '<td rowspan="'.$kq1->num_rows.'">000đ</td>';
                        echo '</tr>';
                       }
                       
                    //    echo '</tr> <td rowspan="'.$kq1->num_rows.'">000đ</td>';
                    //      echo '</tr>'; 
                    //    $tong = $rows['TongTien'];
                        // echo ' 
                        // <td rowspan="'.$kq1->num_rows.'">000đ</td>';
                        //     echo '</tr>';
                }
                
                $tong = $rows['TongTien'];
                echo '<tr>
                 <td colspan="5" align="right">Tổng: '.$tong.'000đ</td>
                 </tr>';
           
    }
}
$sql ="SELECT SUM(TongTien) as tt FROM tbl_hoadon where NgayDatHang BETWEEN '$bd' AND '$kt'";
$kq = mysqli_query(kn(),$sql);
$rows= mysqli_fetch_array($kq);
$temp = $rows['tt'];
echo '<tr>
<td colspan="3" align="right">Tổng danh thu</td>
<td colspan="3" align="right">'.$temp.'000đ</td>
</tr>';
echo  '</table >';
}

if(isset($_POST['loai'])){
    include 'ketnoi.php';
    $gia =0;
    if(isset($_POST['batdaupl'])&&isset($_POST['ketthucpl'])){
        $bd = $_POST['batdaupl'];
        $kt = $_POST['ketthucpl'];
        $loai = $_POST['loai'];
        $temp =0;
        $temp1=0;
        
        $sql ="SELECT *FROM tbl_hoadon where NgayDatHang BETWEEN '$bd' AND '$kt'";
        if($kq = mysqli_query(kn(),$sql)){
                //  echo $kq->num_rows;
                echo '<table border="1" class= "tbgiohang" width=100%>
                <th>Ngày Đặt hàng</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>';
            while ($rows= mysqli_fetch_array($kq)){
                
                $mhd = $rows['MaHoaDon'];
                $sql1 ="SELECT * FROM tbl_chitiethoadon INNER JOIN tbl_sanpham 
                       ON tbl_chitiethoadon.MaSanPham = tbl_sanpham.MaSanPham 
                       AND tbl_chitiethoadon.MaHoaDon = '$mhd' WHERE tbl_sanpham.LoaiSanPham = '$loai'";
                       if($kq1 = mysqli_query(kn(),$sql1))
                       {
                        if($kq1->num_rows){
                            echo '<tr>   
                             <td rowspan="'.$kq1->num_rows.'">'.$rows['NgayDatHang'].'</td>';
                            while ($rows1= mysqli_fetch_array($kq1)){
                                $gia += $rows1['Giá']*$rows1['SoLuongDatHang'];
                                $t = $rows1['Giá']*$rows1['SoLuongDatHang'];
                                echo '     
                              <td>'.$rows1['TenSanPham'].'</td>
                              <td>'.$rows1['SoLuongDatHang'].'</td>
                              <td>'.$rows1['Giá'].'</td>
                              <td>'.$t.'</td>
                              </tr>';     
                            }
                        //    $tong = $rows['TongTien'];
                        //    echo '<tr>
                        //     <td colspan="5" align="right">Tổng: '.$ $gia.'000đ</td>
                        //     </tr>';
                        
                        // $temp +=$tong;
                        $temp1 =3;
                        }
                       }
            }
            
        }
        if($temp1 == 0){
            echo '<div>không có đơn hàng nào được mua trong loại này</div>';
            $temp1=0;
           }
           else {
            echo '<tr>
            <td colspan="3" align="right">Tổng danh thu</td>
            <td colspan="3" align="right">'.$gia.'000đ</td>
            </tr>';
            echo  '</table >';
            // $temp1="";
           }
    }
    else{
        $loai = $_POST['loai'];
        $temp =0;
        $temp1="";
        $sql ="SELECT *FROM tbl_hoadon";
        $gia =0;
        if($kq = mysqli_query(kn(),$sql)){
            $a =0;
            echo '<table border="1" width=100% class="tbgiohang">
                            <th>Mã Hóa Đơn</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>';
            while ($rows= mysqli_fetch_array($kq)){
                $a++;
                $mhd = $rows['MaHoaDon'];
                $sql1 ="SELECT * FROM tbl_chitiethoadon INNER JOIN tbl_sanpham 
                       ON tbl_chitiethoadon.MaSanPham = tbl_sanpham.MaSanPham 
                       AND tbl_chitiethoadon.MaHoaDon = '$mhd' WHERE tbl_sanpham.LoaiSanPham = '$loai'";
                       if($kq1 = mysqli_query(kn(),$sql1))
                       {
                        if($kq1->num_rows){
                            
                            
                            echo '<tr>   
                            <td rowspan="'.$kq1->num_rows.'">'.$rows['NgayDatHang'].'</td>';
                            while ($rows1= mysqli_fetch_array($kq1)){
                                $gia += $rows1['Giá']*$rows1['SoLuongDatHang'];
                                $t = $rows1['Giá']*$rows1['SoLuongDatHang'];
                                echo '  
                              <td>'.$rows1['TenSanPham'].'</td>
                              <td>'.$rows1['SoLuongDatHang'].'</td>
                              <td>'.$rows1['Giá'].'</td>
                              <td>'.$t.'</td>';
                              echo '</tr>';     
                            }
                        $temp1 =3;
                        }
                       }
            }
        }
        if($temp1 == 0){
            echo '<div>không có đơn hàng nào được mua trong loại này</div>';
            $temp1=0;
           }
           else {
            echo '<tr>
            <td colspan="3" align="right">Tổng danh thu</td>
            <td colspan="3" align="right">'.$gia.'000đ</td>
            </tr>';
            echo  '</table >';
            // $temp1="";
           }
    }
   
}

if(isset($_POST['soluong'])){
    include 'ketnoi.php';
    $a = $_POST['soluong'];
    $tongt =0;
    $sql = 'SELECT MaSanPham,COUNT(*) as total_products FROM tbl_chitiethoadon GROUP BY SoLuongDatHang ORDER BY SoLuongDatHang ASC LIMIT 5';
    if($kq = mysqli_query(kn(),$sql)){
        echo '<table border="1" width=100% class="tbgiohang">
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            
                            <th>Giá</th>
                            <th>Số lượng đã bán </th>
                            <th>Tổng tiền</th>';
        while ($rows= mysqli_fetch_array($kq)){
            $msp = $rows['MaSanPham'];
            $sql1 ="SELECT * FROM tbl_sanpham where MaSanPham = '$msp'";
            if($kq1 = mysqli_query(kn(),$sql1)){
                echo '<tr>';
                while($rows1= mysqli_fetch_array($kq1)){
                    $tongt = $rows1['Gia'];
                    echo '<td>'.$rows1['MaSanPham'].'</td>
                    <td>'.$rows1['TenSanPham'].'</td>
                    <td>'.$rows1['Gia'].'</td>'; 
                    
                }
                $tongt = $tongt*$rows['total_products'];
                echo '<td>'.$rows['total_products'].'</td>';
                echo '<td>'.$tongt.'</td>';
                echo '</tr>';
            }
        }
    }
    echo '</table>';
}

if(isset($_POST['soluong1'])){
    include 'ketnoi.php';
    $a = $_POST['soluong1'];
    echo $a;
    $tongt =0;
    $sql = 'SELECT MaSanPham,COUNT(*) as total_products FROM tbl_chitiethoadon GROUP BY SoLuongDatHang ORDER BY SoLuongDatHang ASC LIMIT 5';
    if($kq = mysqli_query(kn(),$sql)){
        echo '<table border="1" width=100% class="tbgiohang">
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            
                            <th>Giá</th>
                            <th>Số lượng đã bán </th>
                            <th>Tổng tiền</th>';
        while ($rows= mysqli_fetch_array($kq)){
            $msp = $rows['MaSanPham'];
            $sql1 ="SELECT * FROM tbl_sanpham where MaSanPham = '$msp'";
            if($kq1 = mysqli_query(kn(),$sql1)){
                echo '<tr>';
                while($rows1= mysqli_fetch_array($kq1)){
                    $tongt = $rows1['Gia'];
                    echo '<td>'.$rows1['MaSanPham'].'</td>
                    <td>'.$rows1['TenSanPham'].'</td>
                    <td>'.$rows1['Gia'].'</td>'; 
                    
                }
                $tongt = $tongt*$rows['total_products'];
                echo '<td>'.$rows['total_products'].'</td>';
                echo '<td>'.$tongt.'</td>';
                echo '</tr>';
            }
        }
    }
    echo '</table>';
//     $sql = 'SELECT MaSanPham,COUNT(*) as total_products FROM tbl_chitiethoadon GROUP BY SoLuongDatHang ORDER BY SoLuongDatHang ASC LIMIT '.$a;
//     if($kq = mysqli_query(kn(),$sql)){
//         echo '<table border="1" width=100% class="tbgiohang">
//                             <th>Mã sản phẩm</th>
//                             <th>Tên sản phẩm</th>
                            
//                             <th>Giá</th>
//                             <th>Số lượng đã bán </th>
//                             <th>Tổng tiền</th>';
//         while ($rows= mysqli_fetch_array($kq)){
//             $msp = $rows['MaSanPham'];
//             $sql1 ="SELECT * FROM tbl_sanpham where MaSanPham = '$msp'";
//             if($kq1 = mysqli_query(kn(),$sql1)){
//                 echo '<tr>';
//                 while($rows1= mysqli_fetch_array($kq1)){
//                     $tongt = $rows1['Gia'];
//                     echo '<td>'.$rows1['MaSanPham'].'</td>
//                     <td>'.$rows1['TenSanPham'].'</td>
//                     <td>'.$rows1['Gia'].'</td>'; 
                    
//                 }
//                 $tongt = $tongt*$rows['total_products'];
//                 echo '<td>'.$rows['total_products'].'</td>';
//                 echo '<td>'.$tongt.'</td>';
//                 echo '</tr>';
//             }
//         }
//     }
//     echo '</table>';
}
?>