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
    <?php
        include 'ketnoi.php';
    ?>
    <div class="thongke giohang">
        <h1>THỐNG KÊ</h1>
        
        <div class="adcontent">
            <div class="danhmuctk">
                <h2>Lọc theo danh mục</h2>
                <div class="thoigian">
            <input type="date" name="tkbatdau" id="tkbatdau">
            <input type="date" name="tkketthuc" id="tkketthuc">
            <button id="tkbtloc">Lọc</button>
        </div>
                <div class="adloai" id="adloai">Loại
                    <?php
                         $sql ="SELECT * FROM tbl_loaisp";
                         $kq = mysqli_query(kn(),$sql);
                        while ($rows= mysqli_fetch_array($kq)){
                            echo '<div id="'.$rows['ID'].'">'.$rows['TênLoai'].'</div>';
                        }
                    ?>
                </div>
                <div class="banchay"> sản phẩm bán chạy
                    <div id='spbc'>
                    <div id="bttrai">bán chạy</div>
                    
                    <!-- <input type="text" id="tksl" value = "1">
                    <div id="btphai">></div> -->
                    </div>
                </div>
                <div id ="back1">
            <button><a href="quantri.php">Quay Lại</a></button>
        </div>
            </div>
            <div id="contenttk">
                
            </div>
        </div>
       
    </div>
    
</body>
</html>
<script>
          $(document).ready(function() {
            $('#tkbtloc').on( "click", function(event) {
            var batdau = $('#tkbatdau').val();
            var ketthuc = $('#tkketthuc').val();
            $.ajax({
                    url: "xulythongke.php",
                    type: 'POST',
                    data: 'batdau='+batdau+'&ketthuc='+ketthuc,
                    success: function(result){
                      $('#contenttk').html(result);
                    }
                })
                event.preventDefault();
            })
            $('#adloai').on( "click", function(event) {
                $('.adloai div').css('display','block')
            })
            $('#bttrai').on( "click", function(event) {
                // $('.adloai div').css('display','block')
                // alert('sds');
                var a =  $('#tksl').val()
                a= parseInt(a)+1;
                a =  $('#tksl').val()
                if(a == 0) a = 1;
                $.ajax({
                    url: "xulythongke.php",
                    type: 'POST',
                    data: "soluong="+a,
                    success: function(result){
                    //   $('#contenttk').html(result);
                    console.log(result)
                    $('#contenttk').html(result);
                    }
                })

            })
            $('#btphai').on( "click", function(event) {
                // $('.adloai div').css('display','block')
                // alert('sds');
                var a =  $('#tksl').val()
                a= parseInt(a)+1;
                $('#tksl').val() = a+""
                $.ajax({
                    url: "xulythongke.php",
                    type: 'POST',
                    data: "soluong1="+a,
                    success: function(result){
                    //   $('#contenttk').html(result);
                    // console.log(result)
                    $('#contenttk').html(result);
                    }
                })

            })
            $('#adloai div').on( "click", function(event) {
                var current = $(event.target).attr('id');
                var batdau = $('#tkbatdau').val();
                var ketthuc = $('#tkketthuc').val();
                var a =""
                if(batdau ==""&& ketthuc==""){
                     a = 'loai='+current
                    }
                    else a = 'batdaupl='+batdau+'&ketthucpl='+ketthuc+'&loai='+current
                    // alert(a)
                    $.ajax({
                    url: "xulythongke.php",
                    type: 'POST',
                    data: a,
                    success: function(result){
                      $('#contenttk').html(result);
                    }
                })
            })
        })
</script>   