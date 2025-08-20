<?php

if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "") {

  header('location:../');
}


display_message();

if (empty($_SESSION['perPage'])) {
  $perpage = 10;
  $_SESSION['perPage'] = $perpage;
  $perpage = $_SESSION['perPage'];
} else {

  $perpage = $_SESSION['perPage'];
}


if (empty($_SESSION['search'])) {

  $search = '';
  $_SESSION['search'] = $search;
} else {

  $search = $_SESSION['search'];
}



if (isset($_POST['search'])) {

  $search = $_POST['search'];
  $_SESSION['search'] = $search;
} else {

  $search = '';
  $_SESSION['search'] = $search;
}

if (isset($_POST['perPage'])) {

  $perPage = $_POST['perPage'];
  $_SESSION['perPage'] = $perPage;
} else {

  $perPage = 10;
  $_SESSION['perPage'] = $perPage;
}
?>



<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">


        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0 fones" style="float: left;">បញ្ជីឈ្មោះសិស្ស :</h5>

            <h5 style="text-align: center;"><button type="button" class="btn btn-primary btnadd" data-toggle="modal" data-target="#exampleModal" role="button"><span style="color:#ffffff" data-toggle="tooltip" title="ចុះឈ្មោះសិស្សថ្មី">ចុះឈ្មោះសិស្សថ្មី</span></button></h5>
          </div>
          <div class="card-body">
            <div class="dataTables_wrapper " style="overflow-x:auto;">

              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_length"><label>Show <select name="table_orderlist_length" aria-controls="table_orderlist" class="perpage custom-select-sm form-control form-control-sm">
                        <option value="10" <?php if (10 == $perpage) { ?> selected="selected" <?php } ?>>10</option>
                        <option value="20" <?php if (25 == $perpage) { ?> selected="selected" <?php } ?>>25</option>
                        <option value="50" <?php if (50 == $perpage) { ?> selected="selected" <?php } ?>>50</option>
                        <option value="100" <?php if (100 == $perpage) { ?> selected="selected" <?php } ?>>100</option>
                      </select> entries</label></div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div id="table_orderlist_filter" class="dataTables_filter"><label>Search:<input type="search" id="search" class="form-control search form-control-sm" placeholder="" aria-controls="table_orderlist" value="<?php echo $search ?>"></label></div>
                </div>
              </div>
              <div id="content_show">
                <table class="table table-striped table-hover " id="">
                  <thead class="bg_color">
                    <tr>
                      <th>N0</th>
                      <th>id</th>
                      <th>ឈ្មោះខ្មែរ</th>
                      <th>ឈ្មោះឡាតាំង</th>
                      <th>ភេទ</th>
                      <th>ថ្ងៃខែឆ្នាំកំណើត</th>
                      <!-- <th>លេខទូរសព្ទ</th> -->
                      <th>មុខវិជ្ជា</th>
                      <th>គ្រូបង្រៀន</th>
                     
                      <th>គិតជា</th>
                      <th>ថ្ងៃខែចូលរៀន</th>
                      <th>ActionIcons</th>

                    </tr>

                  </thead>


                  <tbody>

                    <?php tudentslist($search); ?>

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



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title fones" id="exampleModalLabel">បញ្ចូលឈ្មោះសិស្សថ្មី</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php addstudents(); ?>
          <div class="card card-primary" id="showadd">



          </div>

        </div>
      </div>
    </div>

  </div>





  <div class="modal fade" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title bg_danger" id="exampleModalLabel">ព័ត៌មានសិស្ស</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="view">





        </div>
      </div>
    </div>

  </div>


  <div class="modal fade" id="exampleModal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title bg_primary" id="exampleModalLabel">កែប្រែព័ត៌មានសិស្ស</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <?php update_tudents(); ?>
          <div class="card card-warning" id="teacheredit">


          </div>
        </div>
      </div>
    </div>

  </div>




  <div class="modal fade" id="exampleModalpay" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title bg_primary" id="exampleModalLabel">បង់ថ្លៃសិក្សារ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="payroll">





        </div>
      </div>
    </div>

  </div>







  <script>
    $(function() {

      $('.view').on('click', function() {
        var id = $(this).attr("id");
        $.ajax({
          url: "../resources/templates/back/viewtudents.php",
          method: "get",
          data: {
            id: id
          },
          success: function(data) {

            $('#view').html(data);
            $('#view').append(data.htmlresponse);

          }

        });
      })


    });

    $('.payroll').on('click', function() {
      var id = $(this).attr("id");
      $.ajax({
        url: "../resources/templates/back/Payroll_pay_tudents.php",
        method: "post",
        data: {
          id: id
        },
        success: function(data) {

          $('#payroll').html(data);
          $('#payroll').append(data.htmlresponse);

        }

      });
    })


    $('.btnedit').on('click', function() {
      var id = $(this).attr("id");
      $.ajax({
        url: "../resources/templates/back/edit_tudents.php",
        method: "get",
        data: {
          id: id
        },
        success: function(data) {

          $('#teacheredit').html(data);
          $('#teacheredit').append(data.htmlresponse);

        }

      });
    })

    $('.btnadd').on('click', function() {

      $.ajax({
        url: "../resources/templates/back/pos.php", 
        success: function(data) {
          $('#showadd').html(data);
          $('#showadd').append(data.htmlresponse);
        }
      });
    })

    $('.btn-delete').on('click', function(e) {
      e.preventDefault();
      const href = $(this).attr('href')
      Swal.fire({
        title: "លុបឈ្មោះសិស្ស!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          document.location.href = href;
        }
      })
    })


    $(document).ready(function() {
      $('#table_tudentslist').DataTable({

        "order": [
          [0, "desc"]
        ]
      });
    });
  </script>