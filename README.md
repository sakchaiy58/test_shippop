[![License](http://img.shields.io/badge/license-MIT-lightgrey.svg?style=flat)](http://mit-license.org)

# programmer_test1
FILE :
```html
Download [a link](https://github.com/sakchaiy58/test_shippop/blob/main/Programmer_test1/index.php)
```


# programmer_test1
Download external css and external js :
```html
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!--  icon-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
```

### CSS :
```css
  *{
     font-size: 16px;
     font-family: Cloud;
   }
   .top_row{
      margin-top: 15px
  }
  .result_search{
     padding: 10px; 
     border: 1px solid black; 
     height: 500px; 
     text-align: center;
     font-size:18px;
  }
  .overflow_result{
     overflow: auto; 
     height: 380px; 
     margin-top: 10px;
  }
```

### HTML in body :
```html
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3" > 
        </div>
        <div class="col-sm-6" style="padding: 50px; border: 1px solid black">
             <div class="row">
                  <div class="col-sm-2" >
                       <label style="float:right">List</label>
                   </div>
                   <div class="col-sm-9" >
                        <input type="text" class="form-control" id="search_list_number">
                   </div>
             </div>
             <div class="row top_row">
                   <div class="col-sm-2" >
                        <label style="float:right">ค้นหา</label>
                   </div>
                   <div class="col-sm-5" >
                         <input type="text" class="form-control" id="search_number">
                   </div>
                   <div class="col-sm-3" >
                        <button class="btn btn-warning" onclick="search()">
                            <i class="fa fa-search" aria-hidden="true"></i> ค้นหา 
                        </button>
                    </div>
              </div>
              <div class="row top_row" >
                   <div class="col-sm-12" >
                        <h3 class="text-center">ประเภทการค้นหา</h3>
                    </div>
                    <div class="col-sm-2" >
                            
                    </div>
                   <div class="col-sm-7" >
                        <select class="form-control" id="type_search">
                               <option value="Linear">Linear Search</option>
                               <option value="Binary">Binary Search</option>
                               <option value="Bubble">Bubble Sort</option>
                        </select>
                   </div>
                   <div class="col-sm-3" >
                            
                   </div>
             </div>
             <div class="row">
                  <div class="col-sm-2" >
                            
                  </div>
                  <div class="col-sm-10" >
                       <span class="text-danger">***จากการศึกษาไม่รู้จัก Bubble Search เลยทำ Bubble Sort แทน</span>
                  </div>
              </div>
              <div class="row top_row" >
                    <div class="col-sm-1" >
                            
                    </div>
                    <div class="col-sm-11">
                         <h2 style="margin-left: -15px">ผลลัพธ์</h2>
                    </div>
                    <div class="col-sm-1" >
                            
                    </div>
                    <div class="col-sm-10  result_search">
                         <lable id="show_list_number"></lable><br>
                         <lable id="show_number"></lable><br>
                         <div class="overflow_result">
                               <strong id="show_result" ><br></strong>
                         <div>
                  </div>
              </div>
         </div>
     </div>
</div>
```

### Java Script :
```js
$(document).ready(function(){    
      $('#search_number').on('input', function (event) {
          this.value = this.value.replace(/[^0-9]/g, '');
      });

      $('#search_list_number').on('input', function (event) {
          this.value = this.value.replace(/[^0-9,]/g, '');
      });
});


function search(){
    var type_search = $('#type_search').val();
    var search_list_number = $('#search_list_number').val();
    var search_number = $('#search_number').val();

    if(search_list_number == '' || search_number == ''){
        Swal.fire('กรุณากรอก List และ เลขค้นหา', '', 'error').then(function (result) {
            if (result.value) {
                return false;
            } 
        });
    }else{
        $('#show_list_number').text('List : [ '+search_list_number+' ]');
        $('#show_number').text('Search : '+search_number);
        $.ajax({
                 type: "POST",
                 url: 'function.php?type_search='+type_search,
                 data: {
                     search_list_number : search_list_number,
                     search_number : search_number
                 },
                 success: function(res){
                     var data = JSON.parse(res);
                     if(data.error = "0"){
                         $('#show_result').html(data.result);
                     }else{
                          $('#show_result').html('เกิดข้อผิดพลาดกรุณาลองใหม่');
                     }
                 }
        });
    }
}
```


### PHP IF ELSE FUNCTION SEARCH SELECT :
```PHP
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
?>
```

### PHP Function Linear Search :
```PHP
<?php
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
?>
```

### PHP Function Binary Search :
```PHP
<?php
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

?>
```

### PHP Function Bubble Sort :
```PHP
<?php
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
```