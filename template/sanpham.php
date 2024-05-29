<?php
   if(isset($_GET['masanpham']))
   {
    include 'ketnoi.php';
    $msp = $_GET['masanpham'];
    $sql ="SELECT * FROM tbl_sanpham where MaSanPham = '$msp'";
    $kq = mysqli_query(kn(),$sql);
    while($rows= mysqli_fetch_array($kq)){
        echo '<div id="infoProduct">
        <h1>THÔNG TIN SẢN PHẨM</h1>
        </div>
        <div class = "shopping_cart_item" > <img src="'.$rows['img'].'">
        <div>
        <h3 class="cart-text font_italic">'.$rows['TenSanPham'].'</h3>
            <div>Mô Tả</div>
            <div>'.$rows['MoTa'].'<div>
        </div>
        </div>
        <div class="shopping_cart_title">
        <h5 class="cart-text" >Mã sản phẩm:'.$rows['MaSanPham'].'</h5>
        <input type="number" value="1" id="quantityCart"> <br>
        <button class=" themvaogiohang" id = "msp'.$rows['MaSanPham'].'" >Thêm vào giỏ hàng</button>
        <button class=" close" id = "dongsp">Đóng</button> </div>
        </div>
       ';
    }
   }
   
?>
<script>
    var temp = 1;
    $(document).ready(function() {
           
           $('#timkiem').on( "click", function(event) {
            if(document.getElementById('search').value==""){
                alert('mục tìm kiếm rỗng. Mời nhập')
                document.getElementById('search').focus();
             }
            else {
                var tensp =document.getElementById('search').value;
                kqsanpham(tensp,1);
            }
           
                 event.preventDefault();
             })
             $('button.themvaogiohang').on( "click", function(event) {
            if(parseInt(document.getElementById('quantityCart').value) <= 0){
                alert('Số lượng sản phẩm không được âm') 
                document.getElementById('quantityCart').value = 1;
                document.getElementById('quantityCart').focus();
             }
            else {
                var msp = $(event.target).attr('id');
                var str = msp.slice(3);
                var sl = document.getElementById('quantityCart').value
                giohang(str,sl);
            }
                 event.preventDefault();
             })

             $('#dongsp').on( "click", function(event) {
                document.getElementById('modal').style.display = 'none';
                 event.preventDefault();
             })
            
         })
         function kqsanpham(sp,page){
            $.ajax({
                    type: 'GET',
                    url: "template/timkiemsp.php",
                    data: 'ten='+sp+'&page='+page,
                    success: function(result){ 
                        temp = page;
                        trang(sp);
                        $('#content').html(result) 
                        if( $('#sptk1').css('color','red'));
                    }
                })
        }
        function trang(sp){
            $.ajax({
                    type: 'GET',
                    url: "template/timkiemsp.php",
                    data: 'sotrang='+sp,
                    success: function(result){ 
                        $('#trang').html(result)
                        $('#sptk'+temp+'').css('color','red')
                    }
                })
        }
//thêm vào giỏ hàng
      function giohang(msp,sl){
        $.ajax({
                    type: 'GET',
                    url: "template/giohang.php",
                    data: 'masp='+msp+'&sl='+sl,
                    success: function(result){ 
                        newstr = result.split(" ").join("");
                        newstr =parseInt(newstr)
                        if(parseInt(newstr) == 1)
                            alert('thêm vào giỏ hàng thành công');
                       else
                            alert('xin lỗi, chúng tôi chỉ còn'+newstr+"sản phẩm");    
                    }
                })
      }  
</script>