<?php

if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

  header('location:../');
}


display_message();
?>


<link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">

<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">

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


        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">បង់ពន្ធប្រចាំខែ:</h5>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-12">
                <?php display_message(); ?>
                <?php add_tak(); ?>
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <input type="hidden" name="name" class="form-control" value="បង់ពន្ធប្រចាំខែ" />
                    <div class="col-md-5">
                      <div class="form-group">
                        <div class="input-group date" id="date_1" data-target-input="nearest">
                          <input type="text" class="form-control date_1" data-target="#date_1" name="date" placeholder="បញ្ចូលថ្ងៃខែ">
                          <div class="input-group-append" data-target="#date_1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 ">
                      <input type="text" name="money" class="form-control" placeholder="ចំនួនប្រាក់" />
                    </div>
                    <div class="col-md-3">
                      <button type="submit" name="submit_tak" class="btn btn-success">
                        <i class="fas fa-cloud-download-alt"></i>
                      </button>
                    </div>

                  </div>
                </form>

                <br>
                <div class="divTable" style=" padding: 1px;height: 445px; overflow:auto;">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr style="background: #ecf6ff;">
                        <th>id</th>
                        <th>ប្រភេទ</th>
                        <th>ចំនួនប្រាក់</th>
                        <th>ថ្ងៃខែ</th>
                        <th style="font-family:Khmer OS Battambang;">លុប</th>
                      </tr>
                    </thead>
                    <tbody class="font">
                      <?php get_tak(); ?>

                    </tbody>
                  </table>
                </div>
              </div>


              <script src="js/jquery-3.6.0.min.js"></script>

              <script src="js/jquery-ui.js"></script>

              <script>
                $(document).ready(function() {
                  $.datepicker.setDefaults({
                    dateFormat: 'yy-mm-dd'
                  });
                  $(function() {
                    $("#From").datepicker();
                    $("#Fromm").datepicker();
                    $("#to").datepicker();

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