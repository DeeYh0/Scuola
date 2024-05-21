<?php
function cosin_similarity($a, $b){
    $modulo_a = 0;
    $modulo_b = 0;
    $num = 0;
    $den = 0;
    $vector_len = count($a);

    for($i = 0; $i<$vector_len; $i++){
        $modulo_a += pow($a[$i], 2);
        $modulo_b += pow($b[$i], 2);
    }
    $modulo_a = sqrt($modulo_a);
    $modulo_b = sqrt($modulo_b);
    $den = $modulo_a * $modulo_b;
    
    for($i = 0; $i<$vector_len; $i++){
        $num += $a[$i] * $b[$i];
    }
    
    $dist = $num / $den;
    return $dist;
}

function build_matrix($movies, $users){
    $matrix = [];
    foreach($movies as $movie){
        foreach($users as $user){
           $matrix[$user][$movie['title']] = 0;
        }
    }
    return $matrix;
}
?>
