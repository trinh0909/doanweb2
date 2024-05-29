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
   if(isset($_POST['adtensp'])){
    $TenSP=$_POST['adtensp'];
    $mota=$_POST['admota'];
    $loaisp=$_POST['adloaisp'];
    $NCC=$_POST['adnhacungcap'];
    $Gia=$_POST['adgia'];
    $soluong=$_POST['adsoluong'];
    $hinhanh=$_FILES['adhinhanh']['name'];
    $isDelete =0;
     $sql_1 = "INSERT INTO tbl_sanpham(MaSanPham,TenSanPham,Gia,SoLuongSanPham,MaNhaCungCap,LoaiSanPham,MoTa,img,isDel) values ('$a','$TenSP','$Gia','$soluong','$NCC','$loaisp','$mota','img/$hinhanh',0)";
    if(mysqli_query(kn(),$sql_1)==true){
        move_uploaded_file($_FILES['adhinhanh']['tmp_name'],'../img/'.$hinhanh);
        header('Location:quanlysp.php');
        echo '1';
     $error = "Thêm thành công";
    }
}
?>
<!-- <a href=""></a> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <style>
    table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #add;
  }
  
  th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    border-right: 1px solid #ddd;
  }
  tr:first-child td{
    text-align: center;
  }
  th:first-child,
  td:first-child {
    border-left: 1px solid #ddd;
  }
  
  th:last-child,
  td:last-child {
    border-right: 1px solid #ddd; 
  }
  #adloaisp{
    max-height: 600px; 
    
    overflow-y: auto;
    padding: 20px;
    
  }
  form {
    width: 300px;
  }
  
  label {
    display: block;
    margin-bottom: 8px; 
  }
  .form-sp{
    padding-left: 20px;
    padding-top: 20px;
  }
  input[type="text"],
  input[type="email"],
  input[type="password"],
  input[type="number"],
  input[type="file"]
  {
    padding: 8px; 
    border: 1px solid #ddd; 
    border-radius: 4px; 
    width: 100%; 
    box-sizing: border-box; 
    margin-bottom: 8px; 
  }
  
  button {
    padding: 8px 16px;
    background-color: dodgerblue;
    color: white; 
    border: none; 
    border-radius: 4px; 
    cursor: pointer; 
  }
  select {
    padding: 8px; 
    border: 1px solid #ddd; 
    border-radius: 4px; 
    width: 300px;
    background-color: white; 
    color: #333; 
  }
  
  option {
    padding: 8px; 
  }
  button.btn-them{
    margin-top: 10px;
  }
  a{
    text-decoration: none;
    color: white;
    background-color: dodgerblue;
    padding: 8px 16px;
    border-radius: 4px;
  }

    </style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="">Tên Sản Phẩm</label>
        <input type="text" name="adtensp" placeholder=" Tên sản Phẩm" required=""> <br>
        <label for="">Mô Tả</label>
        <input type="text" name="admota" placeholder= "Mô Tả" required=""><br>
        <label for="">Loại Sản Phẩm</label>
        <select name="adloaisp" id="" required="">
            <option value="1">Tai Nghe</option>
            <option value="2">Sạc Dự Phòng</option>
            <option value="3">Dây Sạc Điện Thoại</option>
            <option value="4">Cục Sạc Điện Thoại</option>
            <option value="5">Loa</option>
        </select> <br>
        <label for=""> Nhà Cung Cấp</label>
        <select name="adnhacungcap" id="" required="">
        <option value="1232">NCC Tai Nghe</option>
        <option value="1233">Sạc Dự Phòng</option>
        <option value="1234">Dây Sạc Điện Thoại</option>
        <option value="1236">Loa</option>
        </select><br>
        <label for="" >Giá</label>
        <input type="number" name="adgia" placeholder= "Giá" required=""><br>
        <label for="">Số Lượng</label>
        <input type="number" name="adsoluong" placeholder= "Số Lương" required=""><br>
        <label for="">Hình Ảnh</label>
        <input type="file" name="adhinhanh" placeholder= "HÌnh Ảnh" required=""><br>
        <button type="submit">Thêm</button>

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
                <td><a style="color = black;" href="edit-sanpham.php?id=<?php echo $value['MaSanPham'] ?>">Sửa</a></td>
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
     <div class ="back">
            <button><a href="quantri.php">Quay Lại</a></button>
        </div>
</body>
</html>