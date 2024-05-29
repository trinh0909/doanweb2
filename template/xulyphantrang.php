<?php
include 'ketnoi.php';
$acx = 1;
   if(isset($_GET['idspl']))
    {
        $theloai = $_GET['idspl'];
            $sp = 6;
            $lsp = $_GET['idspl'];
            $sql ="SELECT * FROM tbl_sanpham where LoaiSanPham = '$lsp' and isDel = 0";
             $kq = mysqli_query(kn(),$sql);
             $tongtrang = $kq->num_rows;
             $sotrang = ceil($tongtrang/$sp);
             if(isset($_GET['page'])) $p = $_GET['page'];
             $pa = $_GET['page'];
             $vt = ($p-1)*$sp;
             $sql ="SELECT * FROM tbl_sanpham where LoaiSanPham = '$lsp' and isDel = 0 limit $vt,$sp";
             $kq = mysqli_query(kn(),$sql);
             while($rows= mysqli_fetch_array($kq)){
                 echo ' <div class="sanpham_item" >
                 <img src='.$rows['img'].' id = sp'.$rows['MaSanPham'].'>
                 <h3>'.$rows['TenSanPham'].'</h3>
                 <h4>Giá: '.$rows['Gia'].'</h4>
                 </div>';
             }
             echo '<div class="modal" id="modal">
             <div class="modal_container">
                 <div id="shopping-cart"></div>
             </div>
         </div>';
    }
    if(isset($_GET['st'])){
        $lsp = $_GET['st'];
        $sp = 6;
        $sql ="SELECT * FROM tbl_sanpham where LoaiSanPham = '$lsp' and isDel = 0";
        $kq = mysqli_query(kn(),$sql);
         $tongtrang = $kq->num_rows;
        $sotrang = ceil($tongtrang/$sp);
            $i = 0;
            while($i!=$sotrang){
                $i++; 
                echo '<a href="javascript:locsp('.$lsp.','.$i.')"  id =lsp'.$i.' class = '.$lsp.'>'.$i.'</a>';
                // echo '<div id =lsp'.$i.' class = '.$lsp.'>'.$i.'</div>';
            }
        }
        ?>
    

    <script>   
        $(document).ready(function() {
            $('div.trang div').on( "click", function(event) {
                        var phanloai = $(event.target).attr('id');
                        var str = phanloai.slice(3);
                        var b = parseInt($(event.target).attr('class'))
                        locsp(b,str);
                        $.ajax({
                            type: 'GET',
                            url: "template/xulyphantrang1.php",
                            data: 'id='+str +"&pa="+b,
                            success: function(result){ 
                                console.log('fygyfyf');
                            }
                        })
                        event.preventDefault();
                    })
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
            console.log('ss')
                event.preventDefault();
             })
         })

</script>