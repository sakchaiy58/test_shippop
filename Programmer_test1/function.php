
<?php

if($_GET['type_search']){

    if($_GET['type_search'] == 'Linear'){
        Linear_search($_POST['search_list_number'], $_POST['search_number']);
    }

    if($_GET['type_search'] == 'Binary'){
        Binary_search($_POST['search_list_number'], $_POST['search_number']);
    }

    if($_GET['type_search'] == 'Bubble'){
        Bubble_sort($_POST['search_list_number']);
    }

}

function Linear_search($search_list_number, $search_number){
    $output = [];
    $output['error'] = '0';
    $output['msg'] = 'OK.';
    $output['result'] = 'Result !!!!<br>';
    $round = 1;

    $arry_search_list_number = explode(",", $search_list_number);
    foreach($arry_search_list_number AS $keys => $value){
        if($value != ''){
            if($value != $search_number){
                $output['result'] .= 'Round : '.$round.  ' ===> '. $value .' != '. $search_number.'<br>';
            }else if($value == $search_number){
                $output['result'] .= 'Round : '.$round.  ' ===> '. $value .' = '. $search_number.' found!!';
                break;
            }
            $round++;
        }
    }
    echo json_encode($output);
}

function Binary_search($search_list_number, $search_number){
    $output = [];
    $output['error'] = '0';
    $output['msg'] = 'OK.';
    $output['result'] = 'Result !!!!<br>';

    $arry_search_list_number = explode(",", $search_list_number);
    sort($arry_search_list_number, SORT_NUMERIC);

    $output['result'] .= 'Sort : [ '.implode(",",$arry_search_list_number).' ] <br>';

    $low = 0;
    $high = count($arry_search_list_number) - 1;
    $round = 1;

    while ($low <= $high) {
        $mid = floor(($low + $high) / 2);
        if($search_number != $arry_search_list_number[$mid]){
            $output['result'] .= 'Round : '.$round.' ===> '.' low = '.$low.', high = '.$high.', Mid = '.$mid.  ' ===> '. $arry_search_list_number[$mid] .' != '. $search_number.'<br>';
            if($search_number < $arry_search_list_number[$mid]){
                $high = $mid -1;
            }else if($search_number > $arry_search_list_number[$mid]){
                $low = $mid + 1;
            }
        }else if($search_number == $arry_search_list_number[$mid] ){
            $output['result'] .= 'Round : '.$round.' ===> '.', low = '.$low.', high = '.$high.' Mid = '.$mid.  ' ===> '. $arry_search_list_number[$mid] .' = '. $search_number.' found!!';
            break;
        }
        $round++;
    }
    echo json_encode($output);
}

function Bubble_sort($search_list_number){
    $output = [];
    $output['error'] = '0';
    $output['msg'] = 'OK.';
    $output['result'] = 'Result !!!!<br>';

    $arry_search_list_number = explode(",", $search_list_number);
    $round = 1;
    $count_arry_search_list_number = count($arry_search_list_number)-1;


    for ($i=0; $i<$count_arry_search_list_number; $i++) {
        for ($j=0; $j<$count_arry_search_list_number-$i; $j++) {
            $k = $j+1;
            if ($arry_search_list_number[$k] < $arry_search_list_number[$j]) {
                $output['result'] .=  'Round : '.$round.' ===> '.$arry_search_list_number[$j]. ' check '. $arry_search_list_number[$k].  ' ===> ';
                list($arry_search_list_number[$j], $arry_search_list_number[$k]) = array($arry_search_list_number[$k], $arry_search_list_number[$j]);
                $output['result'] .=  implode(', ',$arry_search_list_number).'<br>';
            }else{
                $output['result'] .=  'Round : '.$round.' ===> '.$arry_search_list_number[$j]. ' check '. $arry_search_list_number[$k].  ' ===> '. implode(', ',$arry_search_list_number).'<br>';
            }
            $round++;
        }
    }
    echo json_encode($output);
}

?>