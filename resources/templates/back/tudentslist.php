<?php

if ($_SESSION['useremail'] == ""  or $_SESSION['role'] == "") {

  header('location:../');
}


display_message();
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
            <div style="overflow-x:auto;">
              <table class="table table-striped table-hover " id="table_tudentslist">
                <thead class="bg_color">
                  <tr>
                    <th>id</th>
                    <th>ឈ្មោះខ្មែរ</th>
                    <th>ឈ្មោះឡាតាំង</th>
                    <th>ភេទ</th>
                    <th>ថ្ងៃខែឆ្នាំកំណើត</th>
                    <!-- <th>លេខទូរសព្ទ</th> -->
                    <th>មុខវិជ្ជា</th>
                    <th>គ្រូបង្រៀន</th>
                    <th>ថ្នាក់រៀន</th>
                    <th>គិតជា</th>
                    <th>ថ្ងៃខែចូលរៀន</th>
                    <th>ActionIcons</th>

                  </tr>

                </thead>


                <tbody>

                  <?php tudentslist(); ?>

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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title bg_primary" id="exampleModalLabel">បង់ថ្លៃសិក្សារ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php students_Payroll(); ?>
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


