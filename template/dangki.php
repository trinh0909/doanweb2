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
        <h2>ĐĂNG KÝ</h2>
        <form id="formdk" onsubmit="">
            <div class="user-box">
                <input type="text" name="hoten" required="" id="txthoten">
                <label>Họ Tên</label>
              </div>
              <div class="user-box">
                <input type="text" name="std" required=""  id="txtsdt">
                <label>Số điện thoại</label>
              </div>
              <div class="user-box">
                <input type="text" name="dc" required="" id ="txtdc">
                <label>Địa chỉ</label>
              </div>
              <div class="user-box">
                <input type="text" name="user" required="" id ="txtuser">
                <label>Tên đăng nhập</label>
              </div>
              <div class="user-box">
                <input type="password" name="" required="" id ="txtpass">
                <label>Mật Khẩu</label>
              </div>
              <div class="user-box">
                <input type="password" name="nhaplaipass" required="" id="txtnhaplai">
                <label>Nhập lại mật khẩu</label>
              </div>
            <input type="submit" name="dangki" value="đăng ký">
            <br><a href="login.php" class="">Quay lại</a>
        </form>
      </div>
</body>
</html>
 <script>
  // function checkdangky(){
  //   if(document.getElementById('txthoten').value =="")
  //           {
  //               alert("nhập họ và tên");
  //               document.getElementById('txthoten').focus();
  //               return false;
  //           } 
  //       else if(document.getElementById('txtsdt').value ==""){
  //                alert("nhập số điện thoại");
  //               document.getElementById('txtsdt').focus();
  //               return false;
  //       }
  //       else if(document.getElementById('txtuser').value ==""){
  //                alert("nhập số điện thoại");
  //               document.getElementById('txtuser').focus();
  //               return false;
  //       }
  //       else if(document.getElementById('txtpass').value ==""){
  //                alert("nhập số điện thoại");
  //               document.getElementById('txtpass').focus();
  //               return false;
  //       }
  //       else if(document.getElementById('txtnhaplai').value =="")
  //       {
  //              alert("nhập tên mật khẩu");
  //               document.getElementById('txtnhaplai').focus();
  //               return false;
  //       }
  //       else if(document.getElementById('txtnhaplai').value != document.getElementById('txtpass').value ){
  //               alert("mật khẩu không khớp");
  //               return false;
  //       }
  //       return true;
  // }
 </script>
 <script>
   $(document).ready(function(){
    $('#formdk').submit(function(event) {
        $.ajax({
          type: 'POST',
            url: 'xuly.php',
            data: {ht:$('#txthoten').val(),
                   sdt:$('#txtsdt').val(),
                   user:$('#txtuser').val(),
                   pass:$('#txtpass').val(),
                   nl:$('#txtnhaplai').val(),
                   dc: $('#txtdc').val()
                  },
        }).done(function(response) {
          response = response.trim();
            if(response == "1"){
              alert('đăng ký thành công');
              window.location.href = 'login.php';
            }
            else if(response == "0"){
              alert('đăng ký thất bại. Tên đăng nhập đã tồn tại');
              $("#txtuser").select();
              $("#txtuser").focus();
            }
            else if(response == "4"){
              alert('đăng ký thất bại. Số điện thoại không đúng');
              $("#txtsdt").select();
              $("#txtsdt").focus();
            }
            else if(response == "3"){
              alert('đăng ký thất bại. Mật khẩu không trùng nhau');
              $("#txtpass").select();
              $("#txtpass").focus();
            }
        });
        event.preventDefault();
   });
});
</script>