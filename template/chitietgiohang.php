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
    <script src="../js/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="bdgh">
    <form action="xulydathang.php" method ="POST">
    <div class="giohang">
       <h1>GIỎ HÀNG</h1>
       <div class = "boxgh">
            <table border="1" class="tbgiohang" width="100%">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Chỉnh sửa</th>
                </tr>
               
                <?php
                    if(isset($_SESSION['giohang'])){
                        $gia = 0;
                        $tong = 0;
                        if(count($_SESSION['giohang'])>0){
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
                                <td class="edit"><a href="xulydathang.php?xoasp='.$i.'" >Xóa</a></td>
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
                            <td colspan="2" align="center"><input type="submit" value="Lưu chỉnh sửa của bạn" name = "capnhat"></td>
                            <td colspan="3" align="right">Tổng: '.$tong.'</td>
                        </tr>
                            ';
                        }
                  }
                
                ?>
            </table>
            
       </div>
    </div>
    <div class = "btdieuhuong">
        <div><a href="" id="dathang">Đặt hàng</a></div>
        <div><a href="../index.php" >Đóng</a></div>
    </div>
    </form>
    
</body>
</html>

<script>
    $(document).ready(function() {
           $('#dathang').on( "click", function(event) {
                 var a = "sd";
                 $.ajax({
                    type: 'GET',
                    url: "xulydathang.php",
                    data: 'dathang='+a,
                    success: function(result){
                        console.log(result)
                        newstr = result.split(" ").join("");
                        newstr =parseInt(newstr) 
                        if(newstr == 1)
                            {
                                window.location.href = 'dathang.php';
                            }
                        else if(newstr == 2){
                            result = "giỏ hàng rỗng. Bạn có muốn quay lại trang chủ không";
                            if(confirm(result) == true){
                                window.location.href = '../index.php';
                            }
                        }
                        else{
                            result = "Mời bạn đăng nhập để mua hàng";
                            if(confirm(result) == true){
                                window.location.href = 'login.php';
                            }
                        }
                    }
                })
                 event.preventDefault();
             })
         })
</script>
