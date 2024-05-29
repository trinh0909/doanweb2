<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
     include 'xulyphanloai.php';
    ?>
    <div class="tongtrang" id = 'tongtrang'>
        <div class="all_content" id = "all_content">
        <div class="left" id="left_ct"></div>
        <div class="content" name ="content" id = "content">
            <?php
            $sql ="SELECT * FROM tbl_sanpham where isDel = 0";
            $sp = 8;
            $kq = mysqli_query(kn(),$sql);
            $tongtrang = $kq->num_rows;
            $sotrang = ceil($tongtrang/$sp);
            if(isset($_GET['p'])) $p = $_GET['p'];
            else $p = 1;
            $vt = ($p-1)*$sp;
            $end= $vt+$sp;
            $sql ="SELECT * FROM tbl_sanpham where isDel = 0 limit $vt,$sp ";
            $kq = mysqli_query(kn(),$sql);
            while($rows= mysqli_fetch_array($kq)){
                echo ' <div class="sanpham_item">
                <img src='.$rows['img'].' id =sp'.$rows['MaSanPham'].'>
                <h3>'.$rows['TenSanPham'].'</h3>
                <h4>Giá: '.$rows['Gia'].'</h4>
                </div>';
            }
            ?> 
            <div class="modal" id="modal">
                    <div class="modal_container">
                        <div id="shopping-cart"></div>
                    </div>
                </div>
            </div>
            </div>
    <br><div class="trang" id = "trang">
            <?php
            $i = 0;
            while($i!=$sotrang){
                $i++;
                if($i == $p){
                    echo '<span class = "btphantrang">'.$i.'</span>';
                }
                else 
                    echo '<a href="index.php?p='.$i.'">'.$i.'</a>';
            }
            ?>
            </div>
            </div>
       
</body>
</html>

<script>
      $(document).ready(function() {  
           $('.sanpham_item').on( "click", function(event) {
            // var current = $(event.target).attr('id');
            // document.getElementById('modal').style.display = 'block'
            
            //  var a = current.slice(2)
            //  $.ajax({
            //         url: "template/sanpham.php",
            //         type: 'GET',
            //         data: 'masanpham='+a,
            //         success: function(result){
            //         $('#shopping-cart').html(result)
            //         }
            //     })
            console.log('ss')
            //     event.preventDefault();
             })
            
         })
</script>
