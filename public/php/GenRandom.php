<?php
function generateRandom(){
    $alphabets_lower = range('a', 'z');
    $alphabets_upper = range('A', 'Z');
    $number = range(0, 9);
    
    $arr = array_merge($alphabets_lower, $alphabets_upper, $number);
    
    $str = '';
    $str_length = rand(10,15);
    for($i = 0;$i < $str_length; $i++ ){
        $str = $str.$arr[array_rand($arr)];
    }

    return $str;
}
?>