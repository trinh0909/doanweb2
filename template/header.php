<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<?php
include 'sanpham.php';
?>
<body>
    <form action="" method="post">
        <div class = "all_header">
        <div class="header">
                <input type="text" name="" class="header_item" id="search">
                <input type="button" class="header_item" value="search" id = "timkiem">
        </div>
        <div class="topmenu">
            <ul>
                <li><a href="index.php"> <i class="fa-solid fa-house"></i></i> Trang chủ</i></a></li>
                <li><a href="index.php?id=lsp" value = "sp" id ="sp">Sản Phẩm</a></li>
                <li><a href="" id ="gt"></i>Giới thiệu</a></li>
                <li><a href="" id ="ls"></i>Lịch sử</a></li>
                <li><a href="template/chitietgiohang.php"><i class="fa-solid fa-cart-shopping" ></i> Giỏ hàng</a></li>
                <li name = "dn" id="txtdn"><a href="template/login.php" ><i class="fa-solid fa-right-to-bracket" ><input type="hidden" id="custId" name="custId" value ='<?php
                if(isset($_SESSION['user'],$_SESSION['pass']) ){
                    echo "yes";
                }
                else echo "no";
            ?>'></i>Đăng nhập</a></li>
                <li id = "dangxuatus"><a><i class="fa-solid fa-phone" ></i>Đăng xuất</a></li>
                <li id = "ql"><a href="" ><i class="fa-solid fa-phone" ></i>Quản lý</a></li>
                <li><a href=""><i class="fa-solid fa-phone"></i>Liên hệ</a></li>
            </ul>
        </div>
        </div>
        <div class="slide">
            <div><img src="img/anh1.webp" alt=""></div>
            <div><img src="img/anh2.webp" alt=""></div>
            <div><img src="img/anh3.webp" alt=""></div>
            <div><img src="img/anh4.webp" alt=""></div>
        </div>
    </form>
</body>
</html>
<script>
       $(document).ready(function() {
          $('#dangxuatus').on( "click", function(event) {
            var a = 'csp';
            $.ajax({
                    url: "template/xulydangxuat.php",
                    type: 'POST',
                    data: 'dangxuatus='+a,
                    success: function(result){
                        result = parseInt(result)
                        if(result == 1){
                            alert('Đăng xuất thành công')
                        document.getElementById('txtdn').style.display = 'block'
                        document.getElementById('ql').style.display = 'none'
                        }
                        else if(result == 0)
                        alert('Bạn chưa đăng nhập')
                    }
                })
                event.preventDefault();
            })
            
        })
</script>