
<?php
    include 'ketnoi.php';
    // function loadSP($sp){
    //     echo '<div class="left" id="left_ct"></div>
    //     <div class="content" name ="content" id = "content">';
    //     $sql ="SELECT * FROM tbl_sanpham";
    //         $kq = mysqli_query(kn(),$sql);
    //         $tongtrang = $kq->num_rows;
    //         $sotrang = ceil($tongtrang/$sp);
    //         if(isset($_GET['p'])) $p = $_GET['p'];
    //         else $p = 1;
    //         $vt = ($p-1)*$sp;
    //         $end= $vt+$sp;
    //         $sql ="SELECT * FROM tbl_sanpham limit $vt,$sp";
    //         $kq = mysqli_query(kn(),$sql);
    //         while($rows= mysqli_fetch_array($kq)){
    //             echo ' <div class="sanpham_item" id = '.$rows['MaSanPham'].'>
    //             <img src='.$rows['img'].'>
    //             <h3>'.$rows['TenSanPham'].'</h3>
    //             <h4>Giá: '.$rows['Gia'].'</h4>
    //             </div>';
    //         }
    //         echo '</div>';
    // }
    function sotrang(){
            $i = 0;
            global $p,$sotrang;
            while($i!=$sotrang){
                $i++;
                if($i == $p){
                    echo '<span class = "btphantrang">'.$i.'</span>';
                }
                else 
                    echo '<a href="index.php?p='.$i.'">'.$i.'</a>';
            }
         
    }
        if(isset($_GET['idsp'])){
        $sp=6;
        echo ' <div class="all_content" id = "all_content">
        <div class="left" id="left_ct">';
        echo '<div>DANH MỤC SẢN PHẨM</div>';
                $sql ="SELECT * FROM tbl_loaisp ";
                $kq = mysqli_query(kn(),$sql);
                while($rows= mysqli_fetch_array($kq)){
                    echo'<a href="index.php?pl='.$rows['ID'].'" id ='.$rows['ID'].' value ='.$rows['ID'].'>'.$rows['TênLoai'].'</a>';
                }
        echo '</div>
        <div class="content" name ="content" id ="content">';
        $sql ="SELECT * FROM tbl_sanpham where isDel = 0";
            $kq = mysqli_query(kn(),$sql);
            $tongtrang = $kq->num_rows;
            $sotrang = ceil($tongtrang/$sp);
            if(isset($_GET['p1'])) $p = $_GET['p1'];
            else $p = 1;
            $vt = ($p-1)*$sp;
            $end= $vt+$sp;
            $sql ="SELECT * FROM tbl_sanpham where isDel = 0 limit $vt,$sp";
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
            echo '</div>';
            echo '</div>';
            echo '<br><div class="trang" id = "trang">';
            $i = 0;
            while($i!=$sotrang){
                $i++;
                if($i == $p){
                    echo '<span class = "btphantrang">'.$i.'</span>';
                }
                else 
                    echo '<a href="index.php?p1='.$i.'">'.$i.'</a>';
            }
            echo '</div>';
            }
            ?>
        
<script>
    var temp = 1;
        $(document).ready(function() {
           
          $('div.left a').on( "click", function(event) {
                var phanloai = $(event.target).attr('id');
                locsp(phanloai,1)
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
        function locsp(phanloai,page){
            $.ajax({
                    type: 'GET',
                    url: "template/xulyphantrang.php",
                    data: 'idspl='+phanloai +"&page="+page,
                    success: function(result){ 
                        temp = page;
                        soluongtrang(phanloai)
                        $('#content').html(result) 
                        if( $('#lsp1').css('color','red'))
                        console.log(page)
                    }
                })
        }
        function soluongtrang(theloai){
            $.ajax({
                    type: 'GET',
                    url: "template/xulyphantrang.php",
                    data: 'st='+theloai,
                    success: function(result){ 
                        $('#trang').html(result)
                            $('#lsp'+temp+'').css('color','red')
                    }
                })
        }
 </script>
