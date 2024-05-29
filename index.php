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
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="icon/fontawesome-free-6.4.0-web/css/all.min.css">
</head>
<body class = "indexbody">
    <?php
        include('template/header.php');
        include('template/content.php');
        include('template/foodter.php'); 
    ?>
    <script>
        // alert(document.getElementById('custId').value);
    // if(document.getElementById('custId').value == 'admin'){
    // document.getElementById('txtdn').style.display = 'none'
    // document.getElementById('ql').style.display = 'block'
    // }
    // else 
    if(document.getElementById('custId').value == 'yes')
    document.getElementById('txtdn').style.display = 'none'
    </script>
    <script>
            $(document).ready(function() {
          $('#sp').on( "click", function(event) {
            var a = 'csp';
            $.ajax({
                    url: "template/xulyphanloai.php",
                    type: 'GET',
                    data: 'idsp='+a,
                    success: function(result){
                    $('#tongtrang').html(result)
                    document.getElementById('left_ct').style.borderRight = '10px solid #f0eaea'
                    document.getElementById('left_ct').style.display = 'block'   
                    }
                })
                event.preventDefault();
            })
            $('#ls').on( "click", function(event) {
            var a = 'csp';
            $.ajax({
                    url: "template/lichsuDH.php",
                    type: 'GET',
                    data: 'lsdh='+a,
                    success: function(result){
                    result = parseInt(result);
                    if(result == 0){
                        result = "Mời bạn đăng nhập để xem lịch sử đơn hàng"
                        if(confirm(result) == true){
                        window.location.href = 'template/login.php';
                    }
                    }
                    else {
                        window.location.href = 'template/lichsuDH.php';
                    } 
                    }
                })
                event.preventDefault();
            })
            
        })
        function laysp(id){
                $.ajax({
                    url: "template/xulyphanloai.php",
                    type: 'GET',
                    data: 'idspl='+id,
                    success: function(result){
                    $('#tongtrang').html(result)   
                    }
                })
            }
    </script>
   
</body>
</html>
<!-- 
<script>
      $(document).ready(function() {  
           $('.sanpham_item').on( "click", function(event) {
            var current = $(event.target).attr('id');
            document.getElementById('modal').style.display = 'block'
            
             var a = current.slice(2)
             $.ajax({
                    url: "template/sanpham.php",
                    type: 'GET',
                    data: 'masanpham='+a,
                    success: function(result){
                    $('#shopping-cart').html(result)
                    }
                })
                event.preventDefault();
             })
            
         })
</script> -->