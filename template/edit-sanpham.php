<?php 
    include 'ketnoi.php';
    $sql="SELECT * from tbl_sanpham where isDel =0";
   $kq = mysqli_query(kn(),$sql);   
   $sql_1="SELECT * from tbl_sanpham ";
   $kq_1 = mysqli_query(kn(),$sql_1); 
   $a = "";
   while($rows= mysqli_fetch_array($kq_1)){
      $a = $rows['MaSanPham'];
   }
   $a+=1;
   $i=0;
   if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql_show = "SELECT * FROM tbl_sanpham where MaSanPham = $id";
    $result = mysqli_query(kn(),$sql_show);
    $row = mysqli_fetch_assoc($result);
   }
   if(isset($_FILES['adhinhanh'])){
    $TenSP=$_POST['adtensp'];
    $mota=$_POST['admota'];
    $loaisp=$_POST['adloaisp'];
    $NCC=$_POST['adnhacungcap'];
    $Gia=$_POST['adgia'];
    $soluong=$_POST['adsoluong'];
    $hinhanh=$_FILES['adhinhanh']['name'];
    if($hinhanh!=""){
        $sql = "UPDATE tbl_sanpham set TenSanPham = '$TenSP', MoTa = '$mota' , LoaiSanPham = '$loaisp', MaNhaCungCap = '$NCC' , Gia = '$Gia', SoLuongSanPham = '$soluong' , img  = 'img/$hinhanh' where MaSanPham = $id";
        if(mysqli_query(kn(), $sql)){
            move_uploaded_file($_FILES['adhinhanh']['tmp_name'],'../img/'.$hinhanh);
            header('Location:quanlysp.php');
        } 
    }
    else {
        $sql = "UPDATE tbl_sanpham set TenSanPham = '$TenSP', MoTa = '$mota' , LoaiSanPham = '$loaisp', MaNhaCungCap = '$NCC' , Gia = '$Gia', SoLuongSanPham = '$soluong' where MaSanPham = $id";
        if(mysqli_query(kn(), $sql)){
            header('Location:quanlysp.php');
        } 
     } 
     }

?>
<a href=""></a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="">Tên Sản Phẩm</label>
        <input type="text" name="adtensp" placeholder=" Tên sản Phẩm" value = "<?php echo $row['TenSanPham'] ?>"> <br>
        <label for="">Mô Tả</label>
        <input type="text" name="admota" placeholder= "Mô Tả" value="<?php echo $row['MoTa'] ?>"><br>
        <label for="">Loại Sản Phẩm</label>
        <select name="adloaisp" id="">
            <option value="1" <?php if($row['LoaiSanPham']==1) echo "selected" ?>>Tai Nghe</option>
            <option value="2" <?php if($row['LoaiSanPham']==2) echo "selected" ?>>Sạc Dự Phòng</option>
            <option value="3" <?php if($row['LoaiSanPham']==3) echo "selected" ?>>Dây Sạc Điện Thoại</option>
            <option value="4" <?php if($row['LoaiSanPham']==4) echo "selected" ?>>Cục Sạc Điện Thoại</option>
            <option value="5" <?php if($row['LoaiSanPham']==5) echo "selected" ?>>Loa</option>
        </select> <br>
        <label for=""> Nhà Cung Cấp</label>
        <select name="adnhacungcap" id="">
        <option value="1232" <?php if($row['MaNhaCungCap']==1232) echo "selected" ?>>NCC Tai Nghe</option>
        <option value="1233" <?php if($row['MaNhaCungCap']==1233) echo "selected" ?>>Sạc Dự Phòng</option>
        <option value="1234" <?php if($row['MaNhaCungCap']==1234) echo "selected" ?>>Dây Sạc Điện Thoại</option>
        <option value="1236" <?php if($row['MaNhaCungCap']==1236) echo "selected" ?>>Loa</option>
        </select><br>
        <label for="">Giá</label>
        <input type="number" name="adgia" placeholder= "Giá" value="<?php echo $row['Gia'] ?>"><br>
        <label for="">Số Lượng</label>
        <input type="number" name="adsoluong" placeholder= "Số Lương" value="<?php echo $row['SoLuongSanPham'] ?>"><br>
        <label for="">Hình Ảnh</label>
        <img src="../<?php echo $row['img'] ?>" alt="" style = "width : 100px;">
        <input type="file" name="adhinhanh" placeholder= "HÌnh Ảnh"><br>
        <button type="submit">Sửa</button>

    </form>
    <div id="adloaisp">
        <h1>Danh Sách Sản Phẩm</h1>
        <table>
            <tr>
                <td>STT</td>
                <td>Tên sản phẩm</td>
                <td>Mô tả</td>
                <td>Loại sản phẩm</td>
                <td>Nhà Cung Cấp</td>
                <td>Giá</td>
                <td>Số Lượng</td>
                <td>Hình ảnh</td>
                <td>Xóa</td>
                <td>Sửa</td>
            </tr>
            <?php
            foreach($kq as $key => $value){
                $i++;
             ?>
             <tr>
                <td><?php echo $i;?> </td>
                <td><?php echo $value['TenSanPham']; ?> </td>
                <td> <?php echo $value['MoTa']; ?></td>
                <td><?php if($value['LoaiSanPham']==1)echo 'Tai Nghe';
                else if ($value['LoaiSanPham']==2)echo'Sạc Dự Phòng';
                else if ($value['LoaiSanPham']==3)echo 'Dây Sạc Điện Thoại';
                else if ($value['LoaiSanPham']==4)echo 'Cục Sạc Điện Thoại';
                else echo 'Loa';?> </td>
                <td> <?php if($value['MaNhaCungCap']==1232)echo 'NCC Tai Nghe';
                else if($value['MaNhaCungCap']==1233)echo 'Sạc dự phòng';
                else if($value['MaNhaCungCap']==1234)echo 'Dây sạc điện thoại';
                else echo 'Loa';?></td>
                <td> <?php echo $value['Gia'];?> </td>
                <td> <?php  echo $value['SoLuongSanPham'];?> </td>
                <td> <img style ="width : 200px;" src="../<?php echo $value['img']; ?>" alt=""></td>
                <td><button onclick = "del(<?php echo $value['MaSanPham']?>);">Xóa</button></td>
                <td><a style="color = black;" href="quanlysp.php">Sửa</a></td>
             </tr>
             <?php 
            }
             ?>
        </table>
    </div>
    <script>
        function del(id){
            if(confirm("Bạn có chắc chắn muốn xóa")==true){
                window.location.href = "delete-sanpham.php?id="+id;
            }
        }
    </script>
</body>
</html>