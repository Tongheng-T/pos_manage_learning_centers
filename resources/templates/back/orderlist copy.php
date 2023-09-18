<?php


if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

  header('location:../');
}




if (isset($_POST['date_1'])) {
  $_SESSION['date'] = $_POST['date_1'];
  $date_1 = $_POST['date_1'];
  $date_2 = $_POST['date_2'];

  $id_seller = $_POST['category_id'];
  $_SESSION['id_seller'] = $id_seller;

  $_SESSION['date_1'] = $date_1;
  $_SESSION['date_2'] = $date_2;
} else {
  $date_1 = date('Y-m-01');
  $date_2 = date("Y-m-d");
  $_SESSION['date'] = $date_1;
  $_SESSION['date_1'] = $date_1;
  $_SESSION['date_2'] = $date_2;

  $id_seller = '9999';
  $_SESSION['id_seller'] = $id_seller;
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
                    <div class="input-group date" id="date_1" data-target-input="nearest">
                      <input type="text" class="form-control date_1" data-target="#date_1" name="date_1" value="<?php echo $date_1; ?>" data-date-format="yyyy-mm-dd">
                      <div class="input-group-append" data-target="#date_1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="col-md-3">
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

                <div class="col-md-3">
                  <div class="input-group">
                    <div class="input-group-append">
                      <div class="input-group-text"><i class="fa fa-tasks"></i></div>
                    </div>
                    <select class="form-control addEventListener" name="category_id" required>
                      <option value="" disabled selected><?php echo show_scaleL_title($id_seller) ?></option>
                      <?php
                      $select = query("SELECT * from seller_name");
                      confirm($select);
                      while ($row = $select->fetch_object()) {

                        echo '
                             <option value="' . $row->id_staff . '">' . $row->name_seller . '</option>
                                ';
                      }
                      ?>

                    </select>
                  </div>

                </div>

                <div class="col-md-2">

                  <div class="text-center">
                    <button type="submit" class="btn btn-warning" name="btnfilter">Filter Records</button>
                  </div>
                </div>
          </form>
        </div>


        <br>

        <?php

        $selectm = query("SELECT sum(qty) as qtytotal from invoices where date between '$date_1' AND '$date_2'AND id_staff = '$id_seller' and 	id_product = '2' ");
        confirm($selectm);
        $rowm = $selectm->fetch_object();
        $mtotal = $rowm->qtytotal;

        $selectt = query("SELECT sum(qty) as qtytotal from invoices where date between '$date_1' AND '$date_2'AND id_staff = '$id_seller' and 	id_product = '1' ");
        confirm($selectt);
        $rowt = $selectt->fetch_object();
        $ttotal = $rowt->qtytotal;

        $selects = query("SELECT sum(qty) as qtytotal from invoices where date between '$date_1' AND '$date_2'AND id_staff = '$id_seller' and 	id_product = '3' ");
        confirm($selects);
        $rows = $selects->fetch_object();
        $stotal = $rows->qtytotal;

        $select = query("SELECT sum(sub_total) as stotal ,  count(id_oder) as invoice from invoices where date between '$date_1' AND '$date_2'AND id_staff = '$id_seller'");
        confirm($select);

        $row = $select->fetch_object();
        $grand_total = $row->stotal;
        $subtotal = $row->stotal;
        $invoice = $row->invoice;

        ?>



        <div class="row">

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa" style="font-size: 40px;">៛</i></span>

              <div class="info-box-content">
                <span class="info-box-text">លក់បាន</span>
                <span class="info-box-number">
                  <h2><?php echo number_format($subtotal, 2); ?></h2>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tint"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ម៉ាស៊ូត</span>
                <span class="info-box-number">
                  <h2><?php echo number_format($mtotal); ?></h2>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tint"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">សាំងធម្មតា</span>
                <span class="info-box-number">
                  <h2><?php echo number_format($ttotal); ?></h2>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tint"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">សាំងស៊ុបពែរ</span>
                <span class="info-box-number">
                  <h2><?php echo number_format($stotal); ?></h2>
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



        <div id="purchase_order_seller">
          <?php

          $staff = query("SELECT * FROM seller_name where id_staff = '$id_seller'");
          confirm($staff);
          $result = '';
          while ($row = fetch_array($staff)) {
            $id = $row['id_staff'];
            $name_seller = $row['name_seller'];

            $result .= '
               
                  <div class="col-md-12">
                       <h3 class="page-header" style="text-align: center;">' . $name_seller . '</h3>
                       <div class="divTable" style=" padding: 1px;height: 565px; overflow:auto;">
                       <table class="table table-bordered table-striped">
                       <thead>
                          <tr style="background: #ecf6ff;">
                          <th>No</th>
                          <th>id</th>
                          <th>ប្រភេទ</th>
                          <th>ចំនួនលីត្រ</th>
                          <th>តម្លៃរាយ</th>
                          <th>សរុប</th>
               
                          <th>ថ្ងៃខែ</th>
                          </tr>
                       </thead>
                       <tbody>
                         
          
                  ';


            $query = query("SELECT * FROM invoices where date between '$date_1' AND '$date_2'AND id_staff = '$id_seller'");
            $No = 1;
            $subtotal = 0;
            while ($row = fetch_array($query)) {
              $date =  $row['date'];
              $price = $row['sub_total'];
              $date = date('d-m-Y', strtotime($date));
              $subtotal += $price;
              $result .= '
          
                  <tr>
                  <td>' . $No . '</td>
                  <td>' . $row['id_oder'] . '</td>
                  <td>' .show_name_product_oder($row['id_product']) . '</td>
                  <td>' . $row['qty'] . '</td>
                  <td>' . $row['price'] . '</td>
                  <td style="color: #6c00cf;">' . $row['sub_total'] . '</td>
          
                  <td>' . $date . '</td>
                  </tr>
                 
                  ';
              $No++;
            }
            $result .= '
               <tr>
               <td colspan="4">&nbsp;</td>
               <td style="background: #ffc6c6;">សរុប</td>
               <td style="background: #ff7676;">' . $subtotal . '</td>
               </tr>
                </tbody>
                </table>
                </div>
                </div>
               ';
          }
          echo $result;

          ?>
        </div>




      </div>





    </div>
  </div>



</div>
<!-- /.col-md-6 -->
</div>
<!-- /.row -->
</div><!-- /.content-fluid -->