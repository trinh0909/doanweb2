<?php
  class sanpham {
    public $msp;
    public $name;
    public $img;
    public $gia;
}
if(isset($_GET['ten'])){
    $sp = 6;
    $ten = $_GET['ten'];
    include 'ketnoi.php';
    $sql ="SELECT * FROM tbl_sanpham where isDel = 0";
    $kq = mysqli_query(kn(),$sql);
    $arr = array();
    if(isset($_GET['page'])) $p = $_GET['page'];
    else $p =1;
    $pa = $_GET['page'];
    $vt = ($p-1)*$sp;
    while($rows= mysqli_fetch_array($kq)){
        if(strpos(strtolower($rows['TenSanPham']),strtolower($ten)) !== false)
            {
                
                $obj = new sanpham();
                $obj->msp = $rows['MaSanPham'];
                $obj->name = $rows['TenSanPham'];
                $obj->img = $rows['img'];
                $obj->gia = $rows['Gia'];
                array_push($arr,$obj);
            }   
    }
    $temp = $vt+$sp;
    if(count($arr) < $temp){
        $temp = $vt+(count($arr) - $vt);
    }
    for($i = $vt; $i<$temp; $i++){
               echo ' <div class="sanpham_item" >
                 <img src='.$arr[$i]->img.' id = sp'.$arr[$i]->msp.'>
                 <h3>'.$arr[$i]->name.'</h3>
                 <h4>Giá: '.$arr[$i]->gia.'</h4>
                 </div>';
    }
    echo '<div class="modal" id="modal">
    <div class="modal_container">
        <div id="shopping-cart"></div>
    </div>
</div>';
}

if(isset($_GET['sotrang'])){
    $arr = array();
        $ten = $_GET['sotrang'];
        include 'ketnoi.php';
        $sql ="SELECT * FROM tbl_sanpham where isDel = 0";
        $kq = mysqli_query(kn(),$sql);
        while($rows= mysqli_fetch_array($kq)){
            if(strpos(strtolower($rows['TenSanPham']),strtolower($ten)) !== false)
                {    
                    $obj = new sanpham();
                    $obj->msp = $rows['MaSanPham'];
                    $obj->name = $rows['TenSanPham'];
                    $obj->img = $rows['img'];
                    $obj->gia = $rows['Gia'];
                    array_push($arr,$obj);
                }
    }
    $sp = 6;
    $tongtrang = count($arr);
    $sotrang = ceil($tongtrang/$sp);
        $i = 0;
        while($i!=$sotrang){
            $i++; 
            echo '<a  id =sptk'.$i.' class ='.$i.'>'.$i.'</a>';
            // echo '<div id =lsp'.$i.'>'.$i.'</div>';
        }
}

?>

<script>   
        $(document).ready(function() {
            $('div.trang a').on( "click", function(event) {
                        var ten = document.getElementById('search').value;
                        var b = parseInt($(event.target).attr('class'))
                        kqsanpham(ten,b);
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
