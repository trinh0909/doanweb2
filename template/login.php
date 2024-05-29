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
<body class="bodydangnhap">
    <div class="login-box">
        <h2>Login</h2>
        <form id="formdn" method="POST">
          <div class="user-box">
            <input type="text" name="user" required="" id ="txtuser">
            <label>Username</label>
          </div>
          <div class="user-box">
            <input type="password" name="pass" required="" id ="txtpass">
            <label>Password</label>
          </div>
          <div id="ht"></div>
            <input type="submit" name="dangnhap" value="dangnhap">
            <br><a href="../index.php">Thoát</a>
            <br><a href="dangki.php" class="txtdangki">Bạn chưa có tài khoản?</a>
        </form>
      </div>
</body>
</html>
<script>
   $(document).ready(function() {
    $('#formdn').submit(function(event) {
        $.ajax({
          type: 'POST',
            url: 'xuly.php',
            data: {ts1:$('#txtuser').val(),ts2:$('#txtpass').val()},
        }).done(function(response) {
          console.log(response);
          response = parseInt(response);
          if(response == 0){
              window.location.href = '../index.php';
          }
          else if(response == 10)
            {
              response = "Tài Khoản không tồn tại. Mời bạn đăng ký để mua hàng"
              if(confirm(response) == true)
              window.location.href = 'dangki.php';
            }
          else window.location.href = 'quantri.php';
        });
        event.preventDefault(); 
   });
});
</script>
