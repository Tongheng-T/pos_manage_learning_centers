<?php

if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "User") {

  header('location:../');
}


display_message();
update_driver();

?>




<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">


        <div class="card card-success card-outline">
          <div class="card-header">
            <h5 class="m-0 fones" style="float: left;">បញ្ជីឈ្មោះអ្នកបើកបររថយន្ត</h5>
            <h5 style="text-align: center;"><button type="button" class="btn btn-success btnadd" data-toggle="modal" data-target="#exampleModall" role="button"><span style="color:#ffffff" data-toggle="tooltip" title="បញ្ចូលឈ្មោះអ្នកបើកបររថយន្តថ្មី"><i class="fa fa-plus" aria-hidden="true"></i> បញ្ចូលឈ្មោះអ្នកបើកបររថយន្តថ្មី</span></button></h5>
          </div>
          <div class="card-body">
            <div style="overflow-x:auto;">
              <table class="table table-striped table-hover " id="">
                <thead class="bg_color_success">
                  <tr>
                    <th>id</th>
                    <th>ឈ្មោះខ្មែរ</th>
                    <th>ឈ្មោះឡាតាំង</th>
                    <th>ភេទ</th>
                    <th>លេខទូរសព្ទ</th>
                    <th>ប្រភេទរថយន្ត</th>
                    <th>ស្លាកលេខរថយន្ត</th>
                    <th>លេខសំគាល់រថយន្ត</th>
                    <th>ថ្ងៃខែចូលធ្វើការ</th>
                    <th>ActionIcons</th>

                  </tr>

                </thead>


                <tbody>

                  <?php driverlist(); ?>

                </tbody>

              </table>
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
<div class="modal fade" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title bg_success" id="exampleModalLabel">បញ្ចូលឈ្មោះអ្នកបើកបររថយន្តថ្មី</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php add_car_driver(); ?>
      <div class="modal-body" id="showadd">


      </div>
    </div>
  </div>

</div>




<!-- Modal edit-->


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title bg_success" id="exampleModalLabel">កែប្រែព័ត៌មានអ្នកបើកបររថយន្ត</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="purchase_order_seller">





      </div>
    </div>
  </div>

</div>


<div class="modal fade" id="exampleModal_view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title bg_danger" id="exampleModalLabel">ព័ត៌អ្នកបើកបររថយន្ត</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view">





      </div>
    </div>
  </div>

</div>


<!-- ==========================================================payroll====================================== -->

<div class="modal fade" id="exampleModalpay" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title bg_danger" id="exampleModalLabel">ស្រង់ប្រាក់ខែគ្រូ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php driver_Payroll(); ?>
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
        url: "../resources/templates/back/viewt_driver.php",
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


    $('.btnedit').on('click', function() {
      var id = $(this).attr("id");
      $.ajax({
        url: "../resources/templates/back/edit_driver.php",
        method: "get",
        data: {
          id: id
        },
        success: function(data) {

          $('#purchase_order_seller').html(data);
          $('#purchase_order_seller').append(data.htmlresponse);

        }

      });
    })


    $('.btnadd').on('click', function() {

      $.ajax({
        url: "../resources/templates/back/cardriver.php",
        success: function(data) {
          $('#showadd').html(data);
          $('#showadd').append(data.htmlresponse);
        }
      });
    })
  });

  $('.payroll').on('click', function() {
    var id = $(this).attr("id");
    $.ajax({
      url: "../resources/templates/back/Payroll_pay_car.php",
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




  $('.btn-delete').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href')
    Swal.fire({
      title: "លុបឈ្មោះអ្នកបើកបររថយន្ត!",
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
</script>