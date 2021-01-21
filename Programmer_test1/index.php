
<html>
<head> <title> Test_SHIPPON </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!--  icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<!--  ///////////////////////////////////////////////////////// CSS ///////////////////////////////////////////// -->
<style>
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

</style>

<!--  ///////////////////////////////////////////////////////// html ///////////////////////////////////////////// -->
<body >
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
                    <select class="form-control"
                            id="type_search">
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
</body>


<!--////////////////////////////////////////////////  JS /////////////////////////////////////////// -->
<script>
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


</script>
</html>