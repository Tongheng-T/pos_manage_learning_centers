<?php


if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

    header('location:../');
}




if (isset($_POST['date_1'])) {
    $_SESSION['date'] = $_POST['date_1'];
    $date_1 = $_POST['date_1'];
    $date_2 = $_POST['date_2'];
    $tc_id = $_POST['tc_id'];

    $_SESSION['tc_id'] = $tc_id;

    $_SESSION['date_1'] = $date_1;
    $_SESSION['date_2'] = $date_2;
} else {
    $date_1 = date('Y-m-01');
    $date_2 = date("Y-m-d");
    $_SESSION['date'] = $date_1;
    $_SESSION['date_1'] = $date_1;
    $_SESSION['date_2'] = $date_2;
    $tc_id = ' ';
    $_SESSION['tc_id'] = $tc_id;
}

?>

<!-- daterange picker -->
<link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Table Report</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li> -->
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h5 class="m-0">FROM : <?php echo date('d-m-Y', strtotime($date_1)) ?> -- To : <?php echo date('d-m-Y', strtotime($date_2)) ?> </h5>
                    </div>

                    <form action="" method="post" name="">

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <!-- <label>Date:</label> -->
                                        <div class="input-group date" id="date_11" data-target-input="nearest">
                                            <input type="text" class="form-control date_1" data-target="#date_11" name="date_1" value="<?php echo $date_1; ?>" data-date-format="yyyy-mm-dd">
                                            <div class="input-group-append" data-target="#date_11" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <!-- <label>Date:</label> -->
                                        <div class="input-group date" id="date_22" data-target-input="nearest">
                                            <input type="text" class="form-control date_2" data-target="#date_22" name="date_2" value="<?php echo $date_2; ?>" data-date-format="yyyy-mm-dd">
                                            <div class="input-group-append" data-target="#date_22" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-tasks"></i></div>
                                        </div>
                                        <select class="form-control addEventListener" name="tc_id" required>
                                            <?php
                                            show_name_category($tc_id);
                                            $select = query("SELECT * from tbl_teacher order by tc_id desc");
                                            confirm($select);
                                            while ($row = $select->fetch_object()) {

                                                echo '
                                                 <option value="' . $row->tc_id . '">' . $row->tc_nameen . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <div lign="left">
                                        <button type="submit" class="btn btn-warning" name="btnfilter">Filter Records</button>
                                    </div><br>
                                    <button class="btn btn-primary" id="print-btn">Print</button>
                                </div>

                            </div>


                            <br>

                            <?php


                            $selectt = query("SELECT sd_sex, count(sd_sex) as total FROM tbl_students  where sd_sex= 'ប្រុស'  AND sd_teacher_id = '$tc_id'");
                            $select = query("SELECT sd_sex, count(sd_sex) as totalF FROM tbl_students  where sd_sex= 'ស្រី'  AND sd_teacher_id = '$tc_id'");
                            confirm($selectt);

                            $row = $selectt->fetch_assoc();

                            $dd = $row['total'];

                            $row = $select->fetch_assoc();

                            $ddF = $row['totalF'];

                            $select = query("SELECT sum(money) as subtotal , count(sdpay_id ) as invoice  from tbl_employee_students where date between '$date_1' AND '$date_2' AND tc_id = '$tc_id'");
                            confirm($select);

                            $row = $select->fetch_object();

                            $subtotal = $row->subtotal;
                            $invoice = $row->invoice;

                            ?>



                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">TOTAL INVOICE</span>
                                            <span class="info-box-number">
                                                <h2><?php echo number_format($invoice); ?></h2>

                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">TOTAL</span>
                                            <span class="info-box-number">
                                                <h2><?php echo number_format($subtotal); ?></h2>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <!-- fix for small devices only -->
                                <div class="clearfix hidden-md-up"></div>

                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-file"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">សិស្ស</span>
                                            <span class="info-box-number">
                                                <h4><?php echo 'ប្រុស' . $dd . ' ស្រី' . $ddF; ?></h4>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->


                            <br>



                            <div style="overflow-x:auto;">
                                <table class="table table-striped table-hover " id="table_report">
                                    <thead>
                                        <tr>

                                            <td>N0</td>
                                            <td>Invoice ID</td>
                                            <td>Name</td>
                                            <td>Sex</td>
                                            <td>ថ្ងៃខែបង់ប្រាក់</td>


                                            <td>Total</td>





                                        </tr>

                                    </thead>


                                    <tbody>

                                        <?php

                                        $select = query("SELECT * from tbl_employee_students where date between '$date_1' AND '$date_2' AND tc_id = '$tc_id'");
                                        confirm($select);
                                        $total = 0;
                                        $no = 1;
                                        while ($row = $select->fetch_object()) {
                                            $id = $row->sd_id;
                                            $total += $row->money;
                                            $select2 = query("SELECT * from tbl_students where  sd_id = '$id'");
                                            confirm($select2);
                                            while ($rowin = $select2->fetch_object()) {
                                                $sd_nameen = $rowin->sd_nameen;
                                                $sex = $rowin->sd_sex;
                                            }

                                            echo '
                                            <tr>
                                            
                                            <td>' . $no   . '</td>
                                            <td>' . $row->sdpay_id   . '</td>
                                            <td>' . $sd_nameen   . '</td>
                                            <td>' . $sex   . '</td>
                                            <td>' . date('d-m-Y', strtotime($row->date))  . '</td>

                                           
                                            <td><span class="badge badge-danger">' . number_format($row->money) . '</span></td> </tr>';
                                            $no++;
                                        }

                                        echo '<tr>
                                                 <td colspan="4"></td>
                                                 <td>Total</td>
                                                 <td><span class="badge badge-danger">' . number_format($total) . '</span></td> </tr>';


                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>


                    </form>


                </div>
            </div>



        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div><!-- /.content-fluid -->