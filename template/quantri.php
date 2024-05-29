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
<div style="width=100%;">
        <div class ="topmenu">
            <ul>
                <li><a href="" id="dx">Đăng xuất</a></li>
                <li><a href="quanlysp.php">Quản Lý</a></li>
                <li><a href="donhang.php">Đơn hàng</a></li>
                <li><a href="thongke.php">Thống kê</a></li>
            </ul>
        </div>
        <div id="Hello">
            Xin Chào ADMIN :))
        </div>
   </div>
</body>
</html>
<script>
          $(document).ready(function() {
          $('#dx').on( "click", function(event) {
            var a = 'dx';
            $.ajax({
                    url: "xulydangxuat.php",
                    type: 'POST',
                    data: 'dangxuat='+a,
                    success: function(result){
                        window.location.href = '../index.php';
                    }
                })
                event.preventDefault();
            })

        })
</script>   
