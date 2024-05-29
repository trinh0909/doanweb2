<?php          
                                // $weather = array();
                                // $weather[0]['mùa'] = ' mưa';
                                // $weather[1]['mùa'] = ' nắng';
                                // $weather[2]['mùa'] = ' nắng';
                                // $weather[3]['mùa'] = ' nắng';
                                // $weather[4]['mùa'] = ' nắng';
                                // $weather[5]['mùa'] = ' tuyết';  
                                // $weather[6]['mùa'] = ' mưa';
                                // $weather[7]['mùa'] = ' mưa';
                                // $weather[8]['mùa'] = ' tuyết';
                                // $weather[9]['mùa'] = ' tuyết';
                                // $weather[10]['mùa'] = ' mưa';
                                // $weather[11]['mùa'] = ' mưa';

                                // $weather[0]['lá'] = ' rụng';
                                // $weather[1]['lá'] = ' xanh';
                                // $weather[2]['lá'] = ' vàng';
                                // $weather[3]['lá'] = ' xanh';
                                // $weather[4]['lá'] = ' rụng';
                                // $weather[5]['lá'] = ' vàng';
                                // $weather[6]['lá'] = ' rụng ';
                                // $weather[7]['lá'] = ' xanh';
                                // $weather[8]['lá'] = ' xanh';
                                // $weather[9]['lá'] = ' rụng';
                                // $weather[10]['lá'] = ' vàng';
                                // $weather[11]['lá'] = ' xanh';

                                // $weather[0]['nhiệt độ'] = ' thấp';
                                // $weather[1]['nhiệt độ'] = ' trung bình';
                                // $weather[2]['nhiệt độ'] = ' trung bình';
                                // $weather[3]['nhiệt độ'] = ' cao';
                                // $weather[4]['nhiệt độ'] = ' thấp';
                                // $weather[5]['nhiệt độ'] = ' thấp';
                                // $weather[6]['nhiệt độ'] = ' trung bình';  
                                // $weather[7]['nhiệt độ'] = ' cao';
                                // $weather[8]['nhiệt độ'] = ' thấp';
                                // $weather[9]['nhiệt độ'] = ' thấp';
                                // $weather[10]['nhiệt độ'] = ' trung bình';
                                // $weather[11]['nhiệt độ'] = ' trung bình';
                                
                                // $weather[0]['kết quả'] = ' đông';
                                // $weather[1]['kết quả'] = ' xuân';
                                // $weather[2]['kết quả'] = ' thu';
                                // $weather[3]['kết quả'] = ' hè';
                                // $weather[4]['kết quả'] = ' đông';
                                // $weather[5]['kết quả'] = ' đông';
                                // $weather[6]['kết quả'] = ' thu';  
                                // $weather[7]['kết quả'] = ' hè';
                                // $weather[8]['kết quả'] = ' đông';
                                // $weather[9]['kết quả'] = ' đông';
                                // $weather[10]['kết quả'] = ' thu';
                                // $weather[11]['kết quả'] = ' xuân';
                                
                                 $weather[0][0] = ' mưa';
                                $weather[1][0] = ' nắng';
                                $weather[2][0] = ' nắng';
                                $weather[3][0] = ' nắng';
                                $weather[4][0] = ' nắng';
                                $weather[5][0] = ' tuyết';  
                                $weather[6][0] = ' mưa';
                                $weather[7][0] = ' mưa';
                                $weather[8][0] = ' tuyết';
                                $weather[9][0] = ' tuyết';
                                $weather[10][0] = ' mưa';
                                $weather[11][0] = ' mưa';

                                $weather[0][1] = ' rụng';
                                $weather[1][1] = ' xanh';
                                $weather[2][1] = ' vàng';
                                $weather[3][1] = ' xanh';
                                $weather[4][1] = ' rụng';
                                $weather[5][1] = ' vàng';
                                $weather[6][1] = ' rụng ';
                                $weather[7][1] = ' xanh';
                                $weather[8][1] = ' xanh';
                                $weather[9][1] = ' rụng';
                                $weather[10][1] = ' vàng';
                                $weather[11][1] = ' xanh';

                                $weather[0][2] = ' thấp';
                                $weather[1][2] = ' trung bình';
                                $weather[2][2] = ' trung bình';
                                $weather[3][2] = ' cao';
                                $weather[4][2] = ' thấp';
                                $weather[5][2] = ' thấp';
                                $weather[6][2] = ' trung bình';  
                                $weather[7][2] = ' cao';
                                $weather[8][2] = ' thấp';
                                $weather[9][2] = ' thấp';
                                $weather[10][2] = ' trung bình';
                                $weather[11][2] = ' trung bình';
                                
                                $weather[0][3] = ' đông';
                                $weather[1][3] = ' xuân';
                                $weather[2][3] = ' thu';
                                $weather[3][3] = ' hè';
                                $weather[4][3] = ' đông';
                                $weather[5][3] = ' đông';
                                $weather[6][3] = ' thu';  
                                $weather[7][3] = ' hè';
                                $weather[8][3] = ' đông';
                                $weather[9][3] = ' đông';
                                $weather[10][3] = ' thu';
                                $weather[11][3] = ' xuân';
                                // echo '<pre>';
                                // print_r($weather);
                                // echo '</pre>';
                                // $a = array_values($weather[0]);
                                // // function dohonloan($dhl,$arr){
                                //         print_r(is_string($a));
                                // // }
                                // $swe = $weather[0];
                                // // echo  $swe;
                                // for($i=0;$i<count($weather);$i++){
                                        
                                // }
                                // $values = array_values($weather[0]);

                                // // Lặp qua các giá trị trong mảng
                                // foreach ($values as $value) {
                                // // Kiểm tra nếu giá trị là kiểu dữ liệu bạn mong đợi (ví dụ: chuỗi)
                                // if (is_string($value)) {
                                //         echo "Nội dung của khóa không biết trước: " . $value;
                                //         break;
                                // }
                                $hl = [];
                                $temp = $weather[0][0];
                                $dem = 0;
                                for($i=0;$i<count($weather);$i++){
                                        for($j=0;$j<3;$j++)
                                        {
                                                if($temp == $weather[$i][$j])
                                                        $dem++;
                                                echo $dem++;
                                        }
                                }

                              
?>