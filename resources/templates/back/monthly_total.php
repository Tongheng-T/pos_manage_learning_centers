<?php
$date_1 = date('Y-m-d');
$date_2 = date("Y-m-d");

display_message();
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">បង់ទឹកភ្លើង</h1>
            </div><!-- /.col -->
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Admin Page</li>
                </ol>
            </div> -->
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="m-0"></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">


                            <div class="col-md-6">
                                <h4 class="page-header">ស្រង់ប្រាក់ខែបុគ្គលិក </h4>
                                <br>
                                <?php employee_salary(); ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select name="staff_name" id="id_name" class="form-control" required >
            
                                                <?php show_name_staff(); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- <label>Date:</label> -->
                                                <div class="input-group date" id="date_1" data-target-input="nearest">
                                                    <input type="text" class="form-control date_1" id="From" data-target="#date_1" name="date" value="<?php echo $date_1; ?>" data-date-format="yyyy-mm-dd">
                                                    <div class="input-group-append" data-target="#date_1" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 top">
                                            <button type="button" name="search" id="search" class="btn btn-info" style="font-weight: bold;">
                                                ស្វែងរក
                                            </button>
                                        </div>
                                        <div class="row" id="purchase_order_seller">

                                        </div>



                                    </div>
                                </form>

                                <br>
                                <div class="divTable" style=" padding: 1px;height: 400px; overflow:auto;">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="background: #ffdfe2;">
                                                <th>id</th>
                                                <th>ឈ្មោះ</th>
                                                <th>ចំនួនប្រាក់</th>
                                                <th>ថ្ងៃខែ</th>
                                                <th style="font-family:Khmer OS Battambang;">លុប</th>
                                            </tr>
                                        </thead>
                                        <tbody class="font">
                                            <?php get_name_staff(); ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="col-md-6">

                                <h4 class="page-header">បង់ទឹកភ្លើង </h4><br>
                                <?php add_pay_for_water(); ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select name="water" class="form-control">
                                                <option>បង់ភ្លើង</option>
                                                <option>បង់ទឹក</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5 mb-3 ">
                                            <!-- <label>Date:</label> -->
                                            <div class="input-group date" id="date_2" data-target-input="nearest">
                                                <input type="text" class="form-control date_2" data-target="#date_2" name="date" value="<?php echo $date_2; ?>" data-date-format="yyyy-mm-dd">
                                                <div class="input-group-append" data-target="#date_2" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 top">
                                            <input type="text" name="money" class="form-control" placeholder="ចំនួនប្រាក់" required />
                                        </div>
                                        <div class="col-md-4 top">
                                            <button type="submit" name="add_water" class="btn btn-primary toder">
                                                <i class="fas fa-download"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <div class="divTable" style=" padding: 1px;height: 453px; overflow:auto;">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="background: #e7aeff;">
                                                <th>ប្រភេទ</th>
                                                <th>ចំនួនប្រាក់</th>
                                                <th>ថ្ងៃខែ</th>
                                                <th style="font-family:Khmer OS Battambang;">លុប</th>
                                            </tr>
                                        </thead>
                                        <tbody class="font">
                                            <?php get_pay_for_water(); ?>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <script src="js/jquery-3.6.0.min.js"></script>

                            <script src="js/jquery-ui.js"></script>

                            <script>
                                $(document).ready(function() {

                                    $('#search ').click(function() {
                                        var From = $('#From').val();
                                        var id_name = $('#id_name').val();
                                        if (From != '' && id_name != '') {
                                            $.ajax({
                                                url: "../resources/tt.php",
                                                method: "POST",
                                                data: {
                                                    From: From,
                                                    id_name: id_name

                                                },
                                                success: function(data) {
                                                    $('#purchase_order_seller').html(data);
                                                    $('#purchase_order_seller').append(data.htmlresponse);
                                                }
                                            });
                                        } else {
                                            alert("Please Select the Date");
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->