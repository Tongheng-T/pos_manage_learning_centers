<?php


if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

  header('location:../');
}




if (isset($_POST['date_1'])) {
  $_SESSION['date'] = $_POST['date_1'];
  $date_1 = $_POST['date_1'];
  $date_2 = $_POST['date_2'];

  $_SESSION['date_1'] = $date_1;
  $_SESSION['date_2'] = $date_2;
} else {
  $date_1 = date('Y-m-01');
  $date_2 = date("Y-m-d");
  $_SESSION['date'] = $date_1;
  $_SESSION['date_1'] = $date_1;
  $_SESSION['date_2'] = $date_2;
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

                <div class="col-md-5">
                  <div class="form-group">
                    <!-- <label>Date:</label> -->
                    <div class="input-group date" id="date_1" data-target-input="nearest">
                      <input type="text" class="form-control date_1" data-target="#date_1" name="date_1" value="<?php echo $date_1; ?>" data-date-format="yyyy-mm-dd">
                      <div class="input-group-append" data-target="#date_1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <!-- <label>Date:</label> -->
                    <div class="input-group date" id="date_2" data-target-input="nearest">
                      <input type="text" class="form-control date_2" data-target="#date_2" name="date_2" value="<?php echo $date_2; ?>" data-date-format="yyyy-mm-dd">
                      <div class="input-group-append" data-target="#date_2" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>



                </div>

                <div class="col-md-2">

                  <div class="text-center">
                    <button type="submit" class="btn btn-warning" name="btnfilter">Filter Records</button>
                  </div>
                </div>

              </div>


              <br>

              <?php

              $category_query = query("SELECT sum(owe_money) as sowe_money  from debtors");
              confirm($category_query);

              $row_owe_money = $category_query->fetch_object();

              $select = query("SELECT sum(sub_total) as stotal ,  count(id_oder) as invoice from invoices where date between '$date_1' AND '$date_2'");
              confirm($select);
              $row = $select->fetch_object();

              $subtotal = $row->stotal;
              // $invoice = $row->invoice;

              $employee_salar = query("SELECT sum(money) as smoney  from employee_salar where date between '$date_1' AND '$date_2'");
              confirm($employee_salar);
              $watermoney = query("SELECT sum(money) as watermoney  from pay_for_water where date between '$date_1' AND '$date_2'");
              confirm($watermoney);
              $tak = query("SELECT sum(money) as stak  from tak where date between '$date_1' AND '$date_2'");
              confirm($tak);

              $row_watermoney = $watermoney->fetch_object();
              $row_salar = $employee_salar->fetch_object();
              $row_tak = $tak->fetch_object();
              $salar_total  =  $row_salar->smoney;
              $total_water   = $row_watermoney->watermoney;
              $total_tak = $row_tak->stak;

              ?>


              <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                  <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-book"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">ចំណូលលក់បាន</span>
                      <span class="info-box-number">
                        <h2><?php echo number_format($subtotal, 2); ?></h2>

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
                      <span class="info-box-text">បង់ទឹកភ្លើង</span>
                      <span class="info-box-number">
                        <h2><?php echo number_format($total_water, 2); ?></h2>
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
                      <span class="info-box-text">បើកប្រាក់ខែឲ្យបុគ្គលិក</span>
                      <span class="info-box-number">
                        <h2><?php echo number_format($salar_total, 2); ?></h2>
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




              <table class="table table-striped table-hover " id="table_reportt">
                <thead>
                  <tr style="background: #bbc6ff;">
                    <th>ល.រ</th>
                    <th>ប្រភេទ</th>
                    <th>ថ្ងៃខែ</th>
                    <th>ចំនួនប្រាក់</th>

                  </tr>
                </thead>


                <tbody>

                  <?php



                  $select_salar = query("SELECT * from employee_salar where date between '$date_1' AND '$date_2'");
                  confirm($select_salar);
                  $select_watermoney = query("SELECT *  from pay_for_water where date between '$date_1' AND '$date_2'");
                  confirm($select_watermoney);
                  $tak = query("SELECT *  from tak where date between '$date_1' AND '$date_2'");
                  confirm($tak);
                  $date_kh = convert_date($date_2);

                  $No = 1;
                  $total_salar = 0;
                  $total_rak = 0;
                  $total_water = 0;
                  $resultt = "";
                  while ($row = $select_salar->fetch_object()) {
                    $name = show_name_staff_title($row->id_name);
                    $total_salar += $row->money;
                    $resultt .=  '
                    <tr>
                    <td> ' . $No . '</td>
                    <td> (ប្រាក់ខែ) ' . $name . '</td>
                    <td>' . date('d-m-Y', strtotime($row->date)) . '</td>
                    <td style="color: #6c00cf;">' . $row->money . '</td>
                    </tr>';

                    $No++;
                  }
                  while ($rowwater = $select_watermoney->fetch_object()) {
                    $total_water += $rowwater->money;
                    $resultt .=  '
                    <tr>
                    <td> ' . $No . '</td>
                   <td>' . $rowwater->name . '</td>
                   <td>' . date('d-m-Y', strtotime($rowwater->date)) . '</td>
                   <td style="color: #6c00cf;">' . $rowwater->money . '</td>
                   </tr>
                  ';
                    $No++;
                  }
                  while ($row_tak = $tak->fetch_object()) {
                    $total_rak += $row_tak->money;
                    $resultt .=  '
                    <tr>
                    <td> ' . $No . '</td>
                   <td>' . $row_tak->name . $date_kh . '</td>
                   <td>' . date('d-m-Y', strtotime($row_tak->date)) . '</td>
                   <td style="color: #6c00cf;"> ' . $row_tak->money . '</td>
                   </tr>
                  ';
                    $No++;
                  }
                  $total_jom = $total_salar + $total_water + $total_rak;

                  $resultt .=  '
                  <tr>
                  <td> ' . $No . '</td>
                  <td></td>
                  <td style="background: #ffc6c6;"> សរុបចំណាយ</td>
                  <td style="background: #ffc6c6;">' . $total_jom . '</td>
                 </tr>
                ';

                  $resultt .=  '
                <tr>
                <td> </td>
                <td> </td>
                <td> ប្រាក់លក់បានខែ ' . $date_kh . ' </td>
                <td>' . $subtotal . '</td>
               </tr>
              ';

                  $resultt .=  '
              <tr>
              <td> </td>
              <td> </td>
              <td style="background: #ffc6c6;"> ប្រាក់នៅសល់ </td>
              <td style="background: #ff7676;">' . $subtotal - $total_jom . '</td>
             </tr>
             <tr>
             <td> </td>
             <td> </td>
             <td> ប្រាក់ជំពាក់ </td>
             <td style="color: #6c00cf;">' . $row_owe_money->sowe_money . '</td>
             </tr>
             <tr>
             <td> </td>
             <td> ដក់ប្រាក់ជំពាក់នៅសល់ </td>
             <td style="background: #ffc6c6; font-family: Khmer OS Muol Light; color: #ff0101;" >សរុប</td>
             <td style="background: #ff7676;color: #6c00cf;">' . $subtotal - $total_jom - $row_owe_money->sowe_money . '</td>
             </tr>
            ';


                  $No++;

                  echo $resultt;
                  ?>
                </tbody>
              </table>








            </div>


          </form>






        </div>
      </div>



    </div>
    <!-- /.col-md-6 -->
  </div>
  <!-- /.row -->
</div><!-- /.content-fluid -->